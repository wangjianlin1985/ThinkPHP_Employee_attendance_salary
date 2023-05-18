<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\PeixunModel;

class Peixun extends BackBase {
    protected $peixunModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->peixunModel = new PeixunModel();
    }

    /*添加公司培训信息*/
    public function add(){
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
            return view('peixun/peixun_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("peixunId",input("peixunId"));
        return view("peixun/peixun_modify");
    }

    /*ajax方式按照查询条件分页查询公司培训信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->peixunModel->setRows($this->request->param("rows"));
            $mingcheng = input("mingcheng")==null?"":input("mingcheng");
            $shijian = input("shijian")==null?"":input("shijian");
            $didian = input("didian")==null?"":input("didian");
            $addtime = input("addtime")==null?"":input("addtime");
            $peixunRs = $this->peixunModel->queryPeixun($mingcheng, $shijian, $didian, $addtime, $this->currentPage);
            $expTableData = [];
            foreach($peixunRs as $peixunRow) {
                $expTableData[] = $peixunRow;
            }
            $data["rows"] = $peixunRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->peixunModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("peixun/peixun_query");
        }
    }

    /*ajax方式查询公司培训信息*/
    public function listAll() {
        $peixunRs = $this->peixunModel->queryAllPeixun();
        echo json_encode($peixunRs);
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

    /*按照查询条件导出公司培训信息到Excel*/
    public function outToExcel() {
        $mingcheng = input("mingcheng")==null?"":input("mingcheng");
        $shijian = input("shijian")==null?"":input("shijian");
        $didian = input("didian")==null?"":input("didian");
        $addtime = input("addtime")==null?"":input("addtime");
        $peixunRs = $this->peixunModel->queryOutputPeixun($mingcheng,$shijian,$didian,$addtime);
        $expTableData = [];
        foreach($peixunRs as $peixunRow) {
            $expTableData[] = $peixunRow;
        }
        $xlsName = "Peixun";
        $xlsCell = array(
            array('peixunId','培训id','int'),
            array('mingcheng','培训名称','string'),
            array('shijian','培训时间','string'),
            array('didian','培训地点','string'),
            array('addtime','添加时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

