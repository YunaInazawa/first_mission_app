<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Project;
use App\Member;
use App\Role;
use App\Log;
use App\LogCategory;
use App\Element;
use App\Decoration;
use App\Task;
use App\Scene;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ログを登録する関数
     * $logText( String )       : ログの内容
     * $logCategory( String )   : ログのカテゴリ
     * $project_id( integer )   : プロジェクト ID
     */
    function createLog( $logText, $logCategory, $project_id )
    {
        $newLog = new Log;
        $newLog->text = $logText;
        $newLog->log_category_id = LogCategory::where('content', $logCategory)->first()->id;
        $newLog->user_id = Auth::id();
        $newLog->project_id = $project_id;
        $newLog->save();

    }
    
    /**
     * プロジェクト作成
     */
    public function create()
    {
        $usersData = User::whereNotIn('id', [Auth::id()])->orderBy('name')->get();

        return view('app_create', ['users_data' => $usersData]);
    }

    /**
     * プロジェクト作成 / DB登録（POST）
     */
    public function app_new( Request $request )
    {
        // 二重送信禁止
        $request->session()->regenerateToken();  
        
        // データ取得
        $projectName = $request->project_name;
        $projectUsing = $request->project_using;
        $projectDescription = $request->project_description;
        $projectMembers = $request->project_members;

        // プロジェクト作成
        $newProject = new Project;
        $newProject->name = $projectName;
        $newProject->description = $projectDescription;
        $newProject->using = $projectUsing;
        $newProject->save();
        // ログ登録
        $this->createLog('ユーザ「' . Auth::user()->name . '」がプロジェクト「' . $newProject->name . '」を作成', 'create', $newProject->id);

        // メンバ登録(作成者)
        $newMember = new Member;
        $newMember->is_join = true;
        $newMember->project_id = $newProject->id;
        $newMember->user_id = Auth::id();
        $newMember->role_id = Role::where('name', '代表')->first()->id;
        $newMember->save();

        // メンバ登録(参加申請)
        if( $projectMembers != null ){
            foreach( $projectMembers as $member_id ) {
                $newJoinMember = new Member;
                $newJoinMember->project_id = $newProject->id;
                $newJoinMember->user_id = $member_id;
                $newJoinMember->role_id = Role::where('name', '一般')->first()->id;
                $newJoinMember->save();
                // ログ登録
                $this->createLog('ユーザ「' . Auth::user()->name . '」がメンバ「' . $newJoinMember->user->name . '」に参加申請', 'join', $newProject->id);
            }      
        }
        
        return redirect(route('app_home', ['id' => $newProject->id]));
    }

    /**
     * プロジェクト編集
     */
    public function app_edit( $id )
    {
        $projectData = Project::find($id);

        return view('app_edit', ['projectData' => $projectData]);
    }

    /**
     * プロジェクト編集 / DB登録（POST）
     */
    public function app_update( $id, Request $request )
    {
        // 二重送信禁止
        $request->session()->regenerateToken();

        if( $request->has('back') ){
            // 「戻る」ボタンが押されたとき
            return redirect()->route('app_home', $id);
            
        }
        
        // データ取得
        $projectName = $request->project_name;
        $projectUsing = $request->project_using;
        $projectDescription = $request->project_description;

        // プロジェクト作成
        $editProject = Project::find($id);
        $editProject->name = $projectName;
        $editProject->description = $projectDescription;
        $editProject->using = $projectUsing;
        $editProject->save();
        // ログ登録
        $this->createLog('ユーザ「' . Auth::user()->name . '」がプロジェクト「' . $editProject->name . '」を編集', 'update', $editProject->id);
        
        return redirect(route('app_home', ['id' => $editProject->id]))->with('flash_message', 'プロジェクト情報を編集しました');
    }

    /**
     * プロジェクト削除（GET）
     */
    public function app_delete( $id )
    {
        $projectData = Project::find($id);
        $projectName = $projectData->name;
        $projectId = $projectData->id;

        // ログ登録
        $this->createLog('ユーザ「' . Auth::user()->name . '」がプロジェクト「' . $projectName . '」を削除', 'delete', $projectId);

        // DB 削除
        $projectData->delete();
        Scene::where('project_id', $id)->delete();
        Member::where('project_id', $id)->delete();

        return redirect()->route('home')->with('flash_message', 'プロジェクト「' . $projectName . '」を削除しました');
    }

    /**
     * プロジェクト管理
     */
    public function index( $id = 1 )
    {
        $project_data = Project::find($id);
        $members = Member::where('project_id', $id)->where('is_join', true)->orderBy('role_id')->get();
        $members_yet = Member::where('project_id', $id)->where('is_join', null)->orderBy('role_id')->get();
        $logs = Log::where('project_id', $id)->orderBy('id', 'desc')->get();
        $usersData = User::whereNotIn('id', [Auth::id()])->orderBy('name')->get();

        $myRole = Member::where('user_id', Auth::id())->where('project_id', $id)->first()->role->name;

        return view('app_home', ['project_data' => $project_data, 'members' => $members, 'members_yet' => $members_yet, 'logs' => $logs, 'users_data' => $usersData, 'myRole' => $myRole]);
    }

    /**
     * プロジェクト管理 / メンバ追加
     */
    public function add_member( $id, Request $request )
    {
        $request -> session() -> regenerateToken();
        $userName = $request->userName;
        $addUser_id = User::where('name', $userName)->first()->id;

        if( Member::where('user_id', $addUser_id)->where('project_id', $id)->count() == 0 ){
            $addMember = new Member;
            $addMember->project_id = $id;
            $addMember->user_id = $addUser_id;
            $addMember->role_id = Role::where('name', '一般')->first()->id;
            $addMember->save();

            // ログ登録
            $this->createLog('ユーザ「' . Auth::user()->name . '」がメンバ「' . $userName . '」に参加申請', 'join', $id);

            // $msg 登録
            $msg = 'ユーザ「' . $userName . '」に参加申請しました';

        }else{
            // $msg 登録
            $msg = 'ユーザ「' . $userName . '」は申請済みです。';
        }

        return redirect()->back()->with('flash_message', $msg);
    }

    /**
     * プロジェクト管理 / 画面追加
     */
    public function add_screen( $id, Request $request )
    {
        $request -> session() -> regenerateToken();
        $screenName = $request->screenName;
        $screenDescription = $request->screenDescription;

        $addScene = new Scene;
        $addScene->name = $screenName;
        $addScene->description = $screenDescription;
        $addScene->project_id = $id;
        $addScene->save();

        // ログ登録
        $this->createLog('ユーザ「' . Auth::user()->name . '」が画面「' . $addScene->name . '」を作成', 'create', $id);

        return redirect()->back()->with('flash_message', '画面「' . $addScene->name . '」を追加しました');
    }

    /**
     * 画面詳細
     */
    public function screen_detail( $id = 1 )
    {
        $sceneData = Scene::find($id);

        return view('screen_detail', ['sceneId'=> $id, 'sceneData'=> $sceneData]);
    }

    /**
     * タスク詳細
     */
    public function task_detail( $id = 1 )
    {
        $taskData = Task::find($id);
        $andTasksData = Task::where('task_id', $id)->get();

        return view('task_detail', ['taskId'=> $id, 'taskData'=> $taskData, 'andTasksData' => $andTasksData]);
    }

    /**
     * タスク管理
     */
    public function task_edit( $id = 1 )
    {
        return view('task_edit', ['app_id'=> $id]);
    }

    /**
     * デザイン管理
     */
    public function design( $id = 1 )
    {
        $elementsData = Element::orderBy('name')->get();
        $scenesData = Scene::where('project_id', $id)->get();
        $decorationsData = array();
        foreach( $scenesData as $scene ){
            $decorationsData[$scene->id] = Decoration::where('scene_id', $scene->id)->get();
        }

        return view('design', ['app_id'=> $id, 'elements_data' => $elementsData, 'scenes_data' => $scenesData, 'decorations_data' => $decorationsData]);
    }

    /**
     * 画面遷移
     */
    public function transition( $id = 1 )
    {
        $scenesData = Scene::where('project_id', $id)->get();
        $objects = array();
        $elementsId = array();
        $e_name = ['Button', 'Link'];

        foreach( $scenesData as $scene ){
            $objects[$scene->id] = Decoration::where('scene_id', $scene->id)->get();
        }

        foreach( $e_name as $e ){
            $elementsId[$e] = Element::where('name', $e)->first()->id;
        }

        return view('transition', ['projectId'=> $id, 'scenesData' => $scenesData, 'objects' => $objects, 'elementsId' => $elementsId]);
    }

    /**
     * 申請 / 承認拒否
     */
    public function judgmentJoin( $id, Request $request ) 
    {
        $memberData = Member::find($id);
        
        $reply = $request->reply;
        if( $reply ){
            $memberData->is_join = true;
            $memberData->save();
            $result = '承認';

            // ログ登録
            $this->createLog('ユーザ「' . Auth::user()->name . '」がプロジェクト「' . $memberData->project->name . '」に参加', 'join', $memberData->project->id);

        }else{
            $memberData->is_join = false;
            $memberData->save();
            $result = '拒否';

        }

        $msg = 'プロジェクト「' . $memberData->project->name . '」の参加申請を ' . $result . ' しました';
        return redirect()->back()->with('flash_message', $msg);
    }

    /**
     * 画面遷移管理
     */
    public function transition_edit( $id = 1 )
    {
        $scenesData = Scene::where('project_id', $id)->get();
        $objects = array();
        $elementsId = array();
        $e_name = ['Button', 'Link'];

        foreach( $scenesData as $scene ){
            $objects[$scene->id] = Decoration::where('scene_id', $scene->id)->get();
        }

        foreach( $e_name as $e ){
            $elementsId[$e] = Element::where('name', $e)->first()->id;
        }

        return view('transition_edit', ['projectId'=> $id, 'scenesData' => $scenesData, 'objects' => $objects, 'elementsId' => $elementsId]);
    }
}
