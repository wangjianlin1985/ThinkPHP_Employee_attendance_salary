<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\DiaodongModel;

class Diaodong extends BackBase {
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
    public function add(){
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
            return view('diaodong/diaodong_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("id",input("id"));
        return view("diaodong/diaodong_modify");
    }

    /*ajax方式按照查询条件分页查询员工调动信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->diaodongModel->setRows($this->request->param("rows"));
            $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
            $diaodongriqi = input("diaodongriqi")==null?"":input("diaodongriqi");
            $diaodongyuanyin = input("diaodongyuanyin")==null?"":input("diaodongyuanyin");
            $addtime = input("addtime")==null?"":input("addtime");
            $diaodongRs = $this->diaodongModel->queryDiaodong($xingming, $diaodongriqi, $diaodongyuanyin, $addtime, $this->currentPage);
            $expTableData = [];
            foreach($diaodongRs as $diaodongRow) {
                $diaodongRow["xingming"] = $this->employeeModel->getEmployee($diaodongRow["xingming"])["xingming"];
                $diaodongRow["bumenmingcheng"] = $this->bumenModel->getBumen($diaodongRow["bumenmingcheng"])["bumenmingcheng"];
                $diaodongRow["diaodongbumen"] = $this->bumenModel->getBumen($diaodongRow["diaodongbumen"])["bumenmingcheng"];
                $expTableData[] = $diaodongRow;
            }
            $data["rows"] = $diaodongRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->diaodongModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("diaodong/diaodong_query");
        }
    }

    /*ajax方式查询员工调动信息*/
    public function listAll() {
        $diaodongRs = $this->diaodongModel->queryAllDiaodong();
        echo json_encode($diaodongRs);
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

    /*按照查询条件导出员工调动信息到Excel*/
    public function outToExcel() {
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $diaodongriqi = input("diaodongriqi")==null?"":input("diaodongriqi");
        $diaodongyuanyin = input("diaodongyuanyin")==null?"":input("diaodongyuanyin");
        $addtime = input("addtime")==null?"":input("addtime");
        $diaodongRs = $this->diaodongModel->queryOutputDiaodong($xingming,$diaodongriqi,$diaodongyuanyin,$addtime);
        $expTableData = [];
        foreach($diaodongRs as $diaodongRow) {
            $diaodongRow["xingming"] = $this->employeeModel->getEmployee($diaodongRow["xingming"])["xingming"];
            $diaodongRow["bumenmingcheng"] = $this->bumenModel->getBumen($diaodongRow["bumenmingcheng"])["bumenmingcheng"];
            $diaodongRow["diaodongbumen"] = $this->bumenModel->getBumen($diaodongRow["diaodongbumen"])["bumenmingcheng"];
            $expTableData[] = $diaodongRow;
        }
        $xlsName = "Diaodong";
        $xlsCell = array(
            array('xingming','姓名','string'),
            array('bumenmingcheng','部门名称','string'),
            array('danrenzhiwu','担任职务','string'),
            array('yuanjibengongzi','原基本工资','float'),
            array('diaodongzhiwei','调动职位','string'),
            array('diaodongbumen','调动部门','string'),
            array('diaodongriqi','调动日期','string'),
            array('xianjibengongzi','现基本工资','float'),
            array('diaodongyuanyin','调动原因','string'),
            array('addtime','添加时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

