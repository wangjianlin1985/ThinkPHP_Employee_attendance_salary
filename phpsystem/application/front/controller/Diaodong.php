<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\DiaodongModel;
use think\Session;

class Diaodong extends Base {
    protected $bumenModel;
    protected $employeeModel;
    protected $diaodongModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->bumenModel = new BumenModel();
        $this->employeeModel = new EmployeeModel();
        $this->diaodongModel = new DiaodongModel();
    }

    /*添加员工调动信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $diaodong = $this->getDiaodongForm(true);
            try {
                $this->diaodongModel->addDiaodong($diaodong);
                $message = "员工调动添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工调动添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('diaodong/diaodong_frontAdd');
        }
    }

    /*前台修改员工调动信息*/
    public function frontModify() {
        $this->assign("id",input("id"));
        return $this->fetch("diaodong/diaodong_frontModify");
    }

    /*前台按照查询条件分页查询员工调动信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $diaodongriqi = input("diaodongriqi")==null?"":input("diaodongriqi");
        $diaodongyuanyin = input("diaodongyuanyin")==null?"":input("diaodongyuanyin");
        $addtime = input("addtime")==null?"":input("addtime");
        $diaodongRs = $this->diaodongModel->queryDiaodong($xingming, $diaodongriqi, $diaodongyuanyin, $addtime, $this->currentPage);
        $this->assign("diaodongRs",$diaodongRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->diaodongModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->diaodongModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->diaodongModel->rows);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("diaodongriqi",$diaodongriqi);
        $this->assign("diaodongyuanyin",$diaodongyuanyin);
        $this->assign("addtime",$addtime);
        return $this->fetch('diaodong/diaodong_frontlist');
    }


    /*员工前台按照查询条件分页查询员工调动信息*/
    public function empFrontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $xingming["bianhao"] = Session::get("user_name");
        $diaodongriqi = input("diaodongriqi")==null?"":input("diaodongriqi");
        $diaodongyuanyin = input("diaodongyuanyin")==null?"":input("diaodongyuanyin");
        $addtime = input("addtime")==null?"":input("addtime");
        $diaodongRs = $this->diaodongModel->queryDiaodong($xingming, $diaodongriqi, $diaodongyuanyin, $addtime, $this->currentPage);
        $this->assign("diaodongRs",$diaodongRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->diaodongModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->diaodongModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->diaodongModel->rows);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("diaodongriqi",$diaodongriqi);
        $this->assign("diaodongyuanyin",$diaodongyuanyin);
        $this->assign("addtime",$addtime);
        return $this->fetch('diaodong/diaodong_empFrontlist');
    }



    /*ajax方式查询员工调动信息*/
    public function listAll() {
        $diaodongRs = $this->diaodongModel->queryAllDiaodong();
        echo json_encode($diaodongRs);
    }
    /*前台查询根据主键查询一条员工调动信息*/
    public function frontshow() {
        $id = input("id");
        $diaodong = $this->diaodongModel->getDiaodong($id);
       $this->assign("diaodong",$diaodong);
        return $this->fetch("diaodong/diaodong_frontshow");
    }

    /*更新员工调动信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $diaodong = $this->getDiaodongForm(false);
            try {
                $this->diaodongModel->updateDiaodong($diaodong);
                $message = "员工调动更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工调动更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取员工调动对象*/
            $id = input("id");
            $diaodong = $this->diaodongModel->getDiaodong($id);
            echo json_encode($diaodong);
        }
    }

    /*删除多条员工调动记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $ids = input("ids");
        try {
            $count = $this->diaodongModel->deleteDiaodongs($ids);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

