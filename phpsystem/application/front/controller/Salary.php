<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use app\common\model\SalaryModel;
use think\Session;

class Salary extends Base {
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
    public function frontAdd(){
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
            return $this->fetch('salary/salary_frontAdd');
        }
    }

    /*前台修改工资信息*/
    public function frontModify() {
        $this->assign("salaryId",input("salaryId"));
        return $this->fetch("salary/salary_frontModify");
    }

    /*前台按照查询条件分页查询工资信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $nianfen = input("nianfen")==null?"":input("nianfen");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $addtime = input("addtime")==null?"":input("addtime");
        $xingming["bianhao"] = input("xingming_bianhao")==null?"":input("xingming_bianhao");
        $bumenmingcheng["bumenbianhao"] = input("bumenmingcheng_bumenbianhao")==null?"":input("bumenmingcheng_bumenbianhao");
        $salaryRs = $this->salaryModel->querySalary($nianfen, $yuefen, $addtime, $xingming, $bumenmingcheng, $this->currentPage);
        $this->assign("salaryRs",$salaryRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->salaryModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->salaryModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->salaryModel->rows);
        $this->assign("nianfen",$nianfen);
        $this->assign("yuefen",$yuefen);
        $this->assign("addtime",$addtime);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("bumenmingcheng",$bumenmingcheng);
        $this->assign("bumenList",$this->bumenModel->queryAllBumen());
        return $this->fetch('salary/salary_frontlist');
    }

    /*前台员工按照查询条件分页查询工资信息*/
    public function empFrontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $nianfen = input("nianfen")==null?"":input("nianfen");
        $yuefen = input("yuefen")==null?"":input("yuefen");
        $addtime = input("addtime")==null?"":input("addtime");
        $xingming["bianhao"] = Session::get("user_name");
        $bumenmingcheng["bumenbianhao"] = input("bumenmingcheng_bumenbianhao")==null?"":input("bumenmingcheng_bumenbianhao");
        $salaryRs = $this->salaryModel->querySalary($nianfen, $yuefen, $addtime, $xingming, $bumenmingcheng, $this->currentPage);
        $this->assign("salaryRs",$salaryRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->salaryModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->salaryModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->salaryModel->rows);
        $this->assign("nianfen",$nianfen);
        $this->assign("yuefen",$yuefen);
        $this->assign("addtime",$addtime);
        $this->assign("xingming",$xingming);
        $this->assign("employeeList",$this->employeeModel->queryAllEmployee());
        $this->assign("bumenmingcheng",$bumenmingcheng);
        $this->assign("bumenList",$this->bumenModel->queryAllBumen());
        return $this->fetch('salary/salary_empFrontlist');
    }


    /*ajax方式查询工资信息*/
    public function listAll() {
        $salaryRs = $this->salaryModel->queryAllSalary();
        echo json_encode($salaryRs);
    }
    /*前台查询根据主键查询一条工资信息*/
    public function frontshow() {
        $salaryId = input("salaryId");
        $salary = $this->salaryModel->getSalary($salaryId);
       $this->assign("salary",$salary);
        return $this->fetch("salary/salary_frontshow");
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

}

