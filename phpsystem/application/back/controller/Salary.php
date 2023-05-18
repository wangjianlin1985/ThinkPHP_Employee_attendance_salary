<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\SalaryModel;

class Salary extends BackBase {
    protected $bumenModel;
    protected $employeeModel;
    protected $salaryModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->bumenModel = new BumenModel();
        $this->employeeModel = new EmployeeModel();
        $this->salaryModel = new SalaryModel();
    }

    /*添加工资信息*/
    public function add(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $salary = $this->getSalaryForm(true);
            try {
                $this->salaryModel->addSalary($salary);
                $message = "工资添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "工资添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return view('salary/salary_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("salaryId",input("salaryId"));
        return view("salary/salary_modify");
    }

    /*ajax方式按照查询条件分页查询工资信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->salaryModel->setRows($this->request->param("rows"));
            $nianfen = input("nianfen")==null?"":input("nianfen");
            $yuefen = input("yuefen")==null?"":input("yuefen");
            $addtime = input("addtime")==null?"":input("addtime");
            $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
            $bumenmingcheng["bumenbianhao"] = input("bumenmingcheng_bumenbianhao")==null?"":input("bumenmingcheng_bumenbianhao");
            $salaryRs = $this->salaryModel->querySalary($nianfen, $yuefen, $addtime, $xingming, $bumenmingcheng, $this->currentPage);
            $expTableData = [];
            foreach($salaryRs as $salaryRow) {
                $salaryRow["xingming"] = $this->employeeModel->getEmployee($salaryRow["xingming"])["xingming"];
                $salaryRow["bumenmingcheng"] = $this->bumenModel->getBumen($salaryRow["bumenmingcheng"])["bumenmingcheng"];
                $expTableData[] = $salaryRow;
            }
            $data["rows"] = $salaryRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->salaryModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("salary/salary_query");
        }
    }

    /*ajax方式查询工资信息*/
    public function listAll() {
        $salaryRs = $this->salaryModel->queryAllSalary();
        echo json_encode($salaryRs);
    }
    /*更新工资信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $salary = $this->getSalaryForm(false);
            try {
                $this->salaryModel->updateSalary($salary);
                $message = "工资更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "工资更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取工资对象*/
            $salaryId = input("salaryId");
            $salary = $this->salaryModel->getSalary($salaryId);
            echo json_encode($salary);
        }
    }

    /*删除多条工资记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $salaryIds = input("salaryIds");
        try {
            $count = $this->salaryModel->deleteSalarys($salaryIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

    /*按照查询条件导出工资信息到Excel*/
    public function outToExcel() {
        $nianfen = input("nianfen")==null?"":input("nianfen");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $addtime = input("addtime")==null?"":input("addtime");
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $bumenmingcheng["bumenbianhao"] = input("bumenmingcheng_bumenbianhao")==null?"":input("bumenmingcheng_bumenbianhao");
        $salaryRs = $this->salaryModel->queryOutputSalary($nianfen,$yuefen,$addtime,$xingming,$bumenmingcheng);
        $expTableData = [];
        foreach($salaryRs as $salaryRow) {
            $salaryRow["xingming"] = $this->employeeModel->getEmployee($salaryRow["xingming"])["xingming"];
            $salaryRow["bumenmingcheng"] = $this->bumenModel->getBumen($salaryRow["bumenmingcheng"])["bumenmingcheng"];
            $expTableData[] = $salaryRow;
        }
        $xlsName = "Salary";
        $xlsCell = array(
            array('xingming','姓名','string'),
            array('bumenmingcheng','部门名称','string'),
            array('danrenzhiwu','担任职务','string'),
            array('nianfen','年份','string'),
            array('yuefen','月份','string'),
            array('jibengongzi','基本工资','float'),
            array('quanqinjiangli','全勤奖励','float'),
            array('kaohejiangli','考核奖励','float'),
            array('jiabangongzi','加班工资','float'),
            array('gerensuodeshui','个人所得税','float'),
            array('yingfagongzi','应发工资','float'),
            array('shifagongzi','实发工资','float'),
            array('addtime','添加时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

