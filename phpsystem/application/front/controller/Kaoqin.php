<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\KaoqinModel;
use think\Session;

class Kaoqin extends Base {
    protected $bumenModel;
    protected $employeeModel;
    protected $kaoqinModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->bumenModel = new BumenModel();
        $this->employeeModel = new EmployeeModel();
        $this->kaoqinModel = new KaoqinModel();
    }

    /*添加员工考勤信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $kaoqin = $this->getKaoqinForm(true);
            try {
                $this->kaoqinModel->addKaoqin($kaoqin);
                $message = "员工考勤添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工考勤添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('kaoqin/kaoqin_frontAdd');
        }
    }

    /*前台修改员工考勤信息*/
    public function frontModify() {
        $this->assign("kaoqinId",input("kaoqinId"));
        return $this->fetch("kaoqin/kaoqin_frontModify");
    }

    /*前台按照查询条件分页查询员工考勤信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $suoshubumen["bumenbianhao"] = input("suoshubumen_bumenbianhao")==null?"":input("suoshubumen_bumenbianhao");
        $nianfen = input("nianfen")==null?"":input("nianfen");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $addtime = input("addtime")==null?"":input("addtime");
        $kaoqinRs = $this->kaoqinModel->queryKaoqin($xingming, $suoshubumen, $nianfen, $yuefen, $addtime, $this->currentPage);
        $this->assign("kaoqinRs",$kaoqinRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->kaoqinModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->kaoqinModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->kaoqinModel->rows);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("suoshubumen",$suoshubumen);
        $this->assign("bumenList",$this->bumenModel->queryAllBumen());
        $this->assign("nianfen",$nianfen);
        $this->assign("yuefen",$yuefen);
        $this->assign("addtime",$addtime);
        return $this->fetch('kaoqin/kaoqin_frontlist');
    }


    /*前台员工按照查询条件分页查询员工考勤信息*/
    public function empFrontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $xingming["bianhao"] = Session::get("user_name");
        $suoshubumen["bumenbianhao"] = input("suoshubumen_bumenbianhao")==null?"":input("suoshubumen_bumenbianhao");
        $nianfen = input("nianfen")==null?"":input("nianfen");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $addtime = input("addtime")==null?"":input("addtime");
        $kaoqinRs = $this->kaoqinModel->queryKaoqin($xingming, $suoshubumen, $nianfen, $yuefen, $addtime, $this->currentPage);
        $this->assign("kaoqinRs",$kaoqinRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->kaoqinModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->kaoqinModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->kaoqinModel->rows);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("suoshubumen",$suoshubumen);
        $this->assign("bumenList",$this->bumenModel->queryAllBumen());
        $this->assign("nianfen",$nianfen);
        $this->assign("yuefen",$yuefen);
        $this->assign("addtime",$addtime);
        return $this->fetch('kaoqin/kaoqin_empFrontlist');
    }


    /*ajax方式查询员工考勤信息*/
    public function listAll() {
        $kaoqinRs = $this->kaoqinModel->queryAllKaoqin();
        echo json_encode($kaoqinRs);
    }
    /*前台查询根据主键查询一条员工考勤信息*/
    public function frontshow() {
        $kaoqinId = input("kaoqinId");
        $kaoqin = $this->kaoqinModel->getKaoqin($kaoqinId);
       $this->assign("kaoqin",$kaoqin);
        return $this->fetch("kaoqin/kaoqin_frontshow");
    }

    /*更新员工考勤信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $kaoqin = $this->getKaoqinForm(false);
            try {
                $this->kaoqinModel->updateKaoqin($kaoqin);
                $message = "员工考勤更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工考勤更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取员工考勤对象*/
            $kaoqinId = input("kaoqinId");
            $kaoqin = $this->kaoqinModel->getKaoqin($kaoqinId);
            echo json_encode($kaoqin);
        }
    }

    /*删除多条员工考勤记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $kaoqinIds = input("kaoqinIds");
        try {
            $count = $this->kaoqinModel->deleteKaoqins($kaoqinIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

