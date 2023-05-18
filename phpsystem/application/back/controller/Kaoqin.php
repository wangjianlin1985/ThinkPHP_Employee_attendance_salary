<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\KaoqinModel;

class Kaoqin extends BackBase {
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
    public function add(){
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
            return view('kaoqin/kaoqin_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("kaoqinId",input("kaoqinId"));
        return view("kaoqin/kaoqin_modify");
    }

    /*ajax方式按照查询条件分页查询员工考勤信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->kaoqinModel->setRows($this->request->param("rows"));
            $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
            $suoshubumen["bumenbianhao"] = input("suoshubumen_bumenbianhao")==null?"":input("suoshubumen_bumenbianhao");
            $nianfen = input("nianfen")==null?"":input("nianfen");
            $yuefen = input("yuefen")==null?"":input("yuefen");
            $addtime = input("addtime")==null?"":input("addtime");
            $kaoqinRs = $this->kaoqinModel->queryKaoqin($xingming, $suoshubumen, $nianfen, $yuefen, $addtime, $this->currentPage);
            $expTableData = [];
            foreach($kaoqinRs as $kaoqinRow) {
                $kaoqinRow["xingming"] = $this->employeeModel->getEmployee($kaoqinRow["xingming"])["xingming"];
                $kaoqinRow["suoshubumen"] = $this->bumenModel->getBumen($kaoqinRow["suoshubumen"])["bumenmingcheng"];
                $expTableData[] = $kaoqinRow;
            }
            $data["rows"] = $kaoqinRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->kaoqinModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("kaoqin/kaoqin_query");
        }
    }

    /*ajax方式查询员工考勤信息*/
    public function listAll() {
        $kaoqinRs = $this->kaoqinModel->queryAllKaoqin();
        echo json_encode($kaoqinRs);
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

    /*按照查询条件导出员工考勤信息到Excel*/
    public function outToExcel() {
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $suoshubumen["bumenbianhao"] = input("suoshubumen_bumenbianhao")==null?"":input("suoshubumen_bumenbianhao");
        $nianfen = input("nianfen")==null?"":input("nianfen");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $addtime = input("addtime")==null?"":input("addtime");
        $kaoqinRs = $this->kaoqinModel->queryOutputKaoqin($xingming,$suoshubumen,$nianfen,$yuefen,$addtime);
        $expTableData = [];
        foreach($kaoqinRs as $kaoqinRow) {
            $kaoqinRow["xingming"] = $this->employeeModel->getEmployee($kaoqinRow["xingming"])["xingming"];
            $kaoqinRow["suoshubumen"] = $this->bumenModel->getBumen($kaoqinRow["suoshubumen"])["bumenmingcheng"];
            $expTableData[] = $kaoqinRow;
        }
        $xlsName = "Kaoqin";
        $xlsCell = array(
            array('xingming','姓名','string'),
            array('xingbie','性别','string'),
            array('suoshubumen','所属部门','string'),
            array('danrenzhiwu','担任职务','string'),
            array('nianfen','年份','string'),
            array('yuefen','月份','string'),
            array('daoqintianshu','到勤天数','float'),
            array('chidaotianshu','迟到天数','float'),
            array('kuangdaotianshu','旷工天数','float'),
            array('qingjiatianshu','请假天数','float'),
            array('addtime','添加时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

