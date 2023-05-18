<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;

class Bumen extends Base {
    protected $bumenModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->bumenModel = new BumenModel();
    }

    /*添加部门信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $bumen = $this->getBumenForm(true);
            try {
                $this->bumenModel->addBumen($bumen);
                $message = "部门添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "部门添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('bumen/bumen_frontAdd');
        }
    }

    /*前台修改部门信息*/
    public function frontModify() {
        $this->assign("bumenbianhao",input("bumenbianhao"));
        return $this->fetch("bumen/bumen_frontModify");
    }

    /*前台按照查询条件分页查询部门信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $bumenbianhao = input("bumenbianhao")==null?"":input("bumenbianhao");
        $bumenmingcheng = input("bumenmingcheng")==null?"":input("bumenmingcheng");
        $bumenRs = $this->bumenModel->queryBumen($bumenbianhao, $bumenmingcheng, $this->currentPage);
        $this->assign("bumenRs",$bumenRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->bumenModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->bumenModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->bumenModel->rows);
        $this->assign("bumenbianhao",$bumenbianhao);
        $this->assign("bumenmingcheng",$bumenmingcheng);
        return $this->fetch('bumen/bumen_frontlist');
    }

    /*ajax方式查询部门信息*/
    public function listAll() {
        $bumenRs = $this->bumenModel->queryAllBumen();
        echo json_encode($bumenRs);
    }
    /*前台查询根据主键查询一条部门信息*/
    public function frontshow() {
        $bumenbianhao = input("bumenbianhao");
        $bumen = $this->bumenModel->getBumen($bumenbianhao);
       $this->assign("bumen",$bumen);
        return $this->fetch("bumen/bumen_frontshow");
    }

    /*更新部门信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $bumen = $this->getBumenForm(false);
            try {
                $this->bumenModel->updateBumen($bumen);
                $message = "部门更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "部门更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取部门对象*/
            $bumenbianhao = input("bumenbianhao");
            $bumen = $this->bumenModel->getBumen($bumenbianhao);
            echo json_encode($bumen);
        }
    }

    /*删除多条部门记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $bumenbianhaos = input("bumenbianhaos");
        try {
            $count = $this->bumenModel->deleteBumens($bumenbianhaos);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

