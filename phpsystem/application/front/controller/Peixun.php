<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\PeixunModel;

class Peixun extends Base {
    protected $peixunModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->peixunModel = new PeixunModel();
    }

    /*添加公司培训信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $peixun = $this->getPeixunForm(true);
            try {
                $this->peixunModel->addPeixun($peixun);
                $message = "公司培训添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "公司培训添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('peixun/peixun_frontAdd');
        }
    }

    /*前台修改公司培训信息*/
    public function frontModify() {
        $this->assign("peixunId",input("peixunId"));
        return $this->fetch("peixun/peixun_frontModify");
    }

    /*前台按照查询条件分页查询公司培训信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $mingcheng = input("mingcheng")==null?"":input("mingcheng");
        $shijian = input("shijian")==null?"":input("shijian");
        $didian = input("didian")==null?"":input("didian");
        $addtime = input("addtime")==null?"":input("addtime");
        $peixunRs = $this->peixunModel->queryPeixun($mingcheng, $shijian, $didian, $addtime, $this->currentPage);
        $this->assign("peixunRs",$peixunRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->peixunModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->peixunModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->peixunModel->rows);
        $this->assign("mingcheng",$mingcheng);
        $this->assign("shijian",$shijian);
        $this->assign("didian",$didian);
        $this->assign("addtime",$addtime);
        return $this->fetch('peixun/peixun_frontlist');
    }

    /*ajax方式查询公司培训信息*/
    public function listAll() {
        $peixunRs = $this->peixunModel->queryAllPeixun();
        echo json_encode($peixunRs);
    }
    /*前台查询根据主键查询一条公司培训信息*/
    public function frontshow() {
        $peixunId = input("peixunId");
        $peixun = $this->peixunModel->getPeixun($peixunId);
       $this->assign("peixun",$peixun);
        return $this->fetch("peixun/peixun_frontshow");
    }

    /*更新公司培训信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $peixun = $this->getPeixunForm(false);
            try {
                $this->peixunModel->updatePeixun($peixun);
                $message = "公司培训更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "公司培训更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取公司培训对象*/
            $peixunId = input("peixunId");
            $peixun = $this->peixunModel->getPeixun($peixunId);
            echo json_encode($peixun);
        }
    }

    /*删除多条公司培训记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $peixunIds = input("peixunIds");
        try {
            $count = $this->peixunModel->deletePeixuns($peixunIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

