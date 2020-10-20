<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\Member;
use App\Role;
use App\Log;
use App\LogCategory;

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
        return view('app_create');
    }

    /**
     * プロジェクト作成 / DB登録（POST）
     */
    public function new( Request $request )
    {
        // 二重送信禁止
        $request->session()->regenerateToken();  
        
        // データ取得
        $projectName = $request->project_name;
        $projectUsing = $request->project_using;
        $projectDescription = $request->project_description;
        // $projectMembers = $request->members; //メンバー追加後：配列で受け取る

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
        // foreach( $projectMembers as $member_id ) {
        //     $newJoinMember = new Member;
        //     $newJoinMember->project_id = $newProject->id;
        //     $newJoinMember->user_id = $member_id;
        //     $newJoinMember->role_id = Role::where('name', '一般')->first()->id;
        //     $newJoinMember->save();
        //     // ログ登録
        //     $this->createLog('ユーザ「' . Auth::user()->name . '」がメンバ「' . $newJoinMember->user->name . '」に参加申請', 'join', $newProject->id);
        // }        
        
        return redirect(route('app_home', ['id' => $newProject->id]));
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
        return view('app_home', ['project_data' => $project_data, 'members' => $members, 'members_yet' => $members_yet, 'logs' => $logs]);
    }

    /**
     * 画面管理
     */
    public function screen( $id = 1 )
    {
        return view('task_screen', ['app_id'=> $id]);
    }

    /**
     * タスク管理
     */
    public function detail( $id = 1 )
    {
        return view('task_detail', ['app_id'=> $id]);
    }

    /**
     * デザイン管理
     */
    public function design( $id = 1 )
    {
        return view('design', ['app_id'=> $id]);
    }
}
