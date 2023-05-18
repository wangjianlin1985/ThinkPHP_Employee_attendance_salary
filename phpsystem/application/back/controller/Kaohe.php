<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\KaoheModel;

class Kaohe extends BackBase {
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
    public function add(){
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
            return view('kaohe/kaohe_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("kaoheId",input("kaoheId"));
        return view("kaohe/kaohe_modify");
    }

    /*ajax方式按照查询条件分页查询员工考核信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->kaoheModel->setRows($this->request->param("rows"));
            $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
            $bumenObj["bumenbianhao"] = input("bumenObj_bumenbianhao")==null?"":input("bumenObj_bumenbianhao");
            $yuefen = input("yuefen")==null?"":input("yuefen");
            $kaoheRs = $this->kaoheModel->queryKaohe($xingming, $bumenObj, $yuefen, $this->currentPage);
            $expTableData = [];
            foreach($kaoheRs as $kaoheRow) {
                $kaoheRow["xingming"] = $this->employeeModel->getEmployee($kaoheRow["xingming"])["xingming"];
                $kaoheRow["bumenObj"] = $this->bumenModel->getBumen($kaoheRow["bumenObj"])["bumenmingcheng"];
                $kaoheRow["kaohebumen"] = $this->bumenModel->getBumen($kaoheRow["kaohebumen"])["bumenmingcheng"];
                $expTableData[] = $kaoheRow;
            }
            $data["rows"] = $kaoheRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->kaoheModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("kaohe/kaohe_query");
        }
    }

    /*ajax方式查询员工考核信息*/
    public function listAll() {
        $kaoheRs = $this->kaoheModel->queryAllKaohe();
        echo json_encode($kaoheRs);
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

    /*按照查询条件导出员工考核信息到Excel*/
    public function outToExcel() {
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $bumenObj["bumenbianhao"] = input("bumenObj_bumenbianhao")==null?"":input("bumenObj_bumenbianhao");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $kaoheRs = $this->kaoheModel->queryOutputKaohe($xingming,$bumenObj,$yuefen);
        $expTableData = [];
        foreach($kaoheRs as $kaoheRow) {
            $kaoheRow["xingming"] = $this->employeeModel->getEmployee($kaoheRow["xingming"])["xingming"];
            $kaoheRow["bumenObj"] = $this->bumenModel->getBumen($kaoheRow["bumenObj"])["bumenmingcheng"];
            $kaoheRow["kaohebumen"] = $this->bumenModel->getBumen($kaoheRow["kaohebumen"])["bumenmingcheng"];
            $expTableData[] = $kaoheRow;
        }
        $xlsName = "Kaohe";
        $xlsCell = array(
            array('xingming','姓名','string'),
            array('bumenObj','部门','string'),
            array('zhiwu','职务','string'),
            array('nianfen','年份','string'),
            array('yuefen','月份','string'),
            array('kaohejieguo','考核结果','string'),
            array('kaohebumen','考核部门','string'),
            array('addtime','添加时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

