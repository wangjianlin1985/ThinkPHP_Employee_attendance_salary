<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;

class Bumen extends BackBase {
    protected $bumenModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->bumenModel = new BumenModel();
    }

    /*添加部门信息*/
    public function add(){
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
            return view('bumen/bumen_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("bumenbianhao",input("bumenbianhao"));
        return view("bumen/bumen_modify");
    }

    /*ajax方式按照查询条件分页查询部门信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->bumenModel->setRows($this->request->param("rows"));
            $bumenbianhao = input("bumenbianhao")==null?"":input("bumenbianhao");
            $bumenmingcheng = input("bumenmingcheng")==null?"":input("bumenmingcheng");
            $bumenRs = $this->bumenModel->queryBumen($bumenbianhao, $bumenmingcheng, $this->currentPage);
            $expTableData = [];
            foreach($bumenRs as $bumenRow) {
                $expTableData[] = $bumenRow;
            }
            $data["rows"] = $bumenRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->bumenModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("bumen/bumen_query");
        }
    }

    /*ajax方式查询部门信息*/
    public function listAll() {
        $bumenRs = $this->bumenModel->queryAllBumen();
        echo json_encode($bumenRs);
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

    /*按照查询条件导出部门信息到Excel*/
    public function outToExcel() {
        $bumenbianhao = input("bumenbianhao")==null?"":input("bumenbianhao");
        $bumenmingcheng = input("bumenmingcheng")==null?"":input("bumenmingcheng");
        $bumenRs = $this->bumenModel->queryOutputBumen($bumenbianhao,$bumenmingcheng);
        $expTableData = [];
        foreach($bumenRs as $bumenRow) {
            $expTableData[] = $bumenRow;
        }
        $xlsName = "Bumen";
        $xlsCell = array(
            array('bumenbianhao','部门编号','string'),
            array('bumenmingcheng','部门名称','string'),
            array('addtime','添加时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

