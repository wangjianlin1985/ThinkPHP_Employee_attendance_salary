<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\KaoheModel;
use think\Session;

class Kaohe extends Base {
    protected $bumenModel;
    protected $employeeModel;
    protected $kaoheModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->bumenModel = new BumenModel();
        $this->employeeModel = new EmployeeModel();
        $this->kaoheModel = new KaoheModel();
    }

    /*添加员工考核信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $kaohe = $this->getKaoheForm(true);
            try {
                $this->kaoheModel->addKaohe($kaohe);
                $message = "员工考核添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工考核添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('kaohe/kaohe_frontAdd');
        }
    }

    /*前台修改员工考核信息*/
    public function frontModify() {
        $this->assign("kaoheId",input("kaoheId"));
        return $this->fetch("kaohe/kaohe_frontModify");
    }

    /*前台按照查询条件分页查询员工考核信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $bumenObj["bumenbianhao"] = input("bumenObj_bumenbianhao")==null?"":input("bumenObj_bumenbianhao");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $kaoheRs = $this->kaoheModel->queryKaohe($xingming, $bumenObj, $yuefen, $this->currentPage);
        $this->assign("kaoheRs",$kaoheRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->kaoheModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->kaoheModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->kaoheModel->rows);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("bumenObj",$bumenObj);
        $this->assign("bumenList",$this->bumenModel->queryAllBumen());
        $this->assign("yuefen",$yuefen);
        return $this->fetch('kaohe/kaohe_frontlist');
    }


    /*前台员工按照查询条件分页查询员工考核信息*/
    public function empFrontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $xingming["bianhao"] = Session::get("user_name");
        $bumenObj["bumenbianhao"] = input("bumenObj_bumenbianhao")==null?"":input("bumenObj_bumenbianhao");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $kaoheRs = $this->kaoheModel->queryKaohe($xingming, $bumenObj, $yuefen, $this->currentPage);
        $this->assign("kaoheRs",$kaoheRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->kaoheModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->kaoheModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->kaoheModel->rows);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("bumenObj",$bumenObj);
        $this->assign("bumenList",$this->bumenModel->queryAllBumen());
        $this->assign("yuefen",$yuefen);
        return $this->fetch('kaohe/kaohe_empFrontlist');
    }



    /*ajax方式查询员工考核信息*/
    public function listAll() {
        $kaoheRs = $this->kaoheModel->queryAllKaohe();
        echo json_encode($kaoheRs);
    }
    /*前台查询根据主键查询一条员工考核信息*/
    public function frontshow() {
        $kaoheId = input("kaoheId");
        $kaohe = $this->kaoheModel->getKaohe($kaoheId);
       $this->assign("kaohe",$kaohe);
        return $this->fetch("kaohe/kaohe_frontshow");
    }

    /*更新员工考核信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $kaohe = $this->getKaoheForm(false);
            try {
                $this->kaoheModel->updateKaohe($kaohe);
                $message = "员工考核更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工考核更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取员工考核对象*/
            $kaoheId = input("kaoheId");
            $kaohe = $this->kaoheModel->getKaohe($kaoheId);
            echo json_encode($kaohe);
        }
    }

    /*删除多条员工考核记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $kaoheIds = input("kaoheIds");
        try {
            $count = $this->kaoheModel->deleteKaohes($kaoheIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

