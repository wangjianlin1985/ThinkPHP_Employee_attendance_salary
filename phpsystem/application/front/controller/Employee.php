<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;
use think\Session;

class Employee extends Base {
    protected $bumenModel;
    protected $employeeModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->bumenModel = new BumenModel();
        $this->employeeModel = new EmployeeModel();
    }

    /*添加员工信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $employee = $this->getEmployeeForm(true);
            $this->uploadPhoto($employee,"zhaopian","zhaopianFile"); //处理照片上传
			$employee['addtime'] = date('Y-m-d H:i:s');
            try {
                $this->employeeModel->addEmployee($employee);
                $message = "员工添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('employee/employee_frontAdd');
        }
    }

    /*前台修改员工信息*/
    public function frontModify() {
        $this->assign("bianhao",input("bianhao"));
        return $this->fetch("employee/employee_frontModify");
    }


    /*前台修改员工信息*/
    public function frontSelfModify() {
        $this->assign("bianhao", Session::get("user_name") );
        return $this->fetch("employee/employee_frontSelfModify");
    }


    /*前台按照查询条件分页查询员工信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $bianhao = input("bianhao")==null?"":input("bianhao");
        $xingming = input("xingming")==null?"":input("xingming");
        $bumenObj["bumenbianhao"] = input("bumenObj_bumenbianhao")==null?"":input("bumenObj_bumenbianhao");
        $danrenzhiwu = input("danrenzhiwu")==null?"":input("danrenzhiwu");
        $chushengriqi = input("chushengriqi")==null?"":input("chushengriqi");
        $shenfenzhenghao = input("shenfenzhenghao")==null?"":input("shenfenzhenghao");
        $employeeRs = $this->employeeModel->queryEmployee($bianhao, $xingming, $bumenObj, $danrenzhiwu, $chushengriqi, $shenfenzhenghao, $this->currentPage);
        $this->assign("employeeRs",$employeeRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->employeeModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->employeeModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->employeeModel->rows);
        $this->assign("bianhao",$bianhao);
        $this->assign("xingming",$xingming);
        $this->assign("bumenObj",$bumenObj);
        $this->assign("bumenList",$this->bumenModel->queryAllBumen());
        $this->assign("danrenzhiwu",$danrenzhiwu);
        $this->assign("chushengriqi",$chushengriqi);
        $this->assign("shenfenzhenghao",$shenfenzhenghao);
        return $this->fetch('employee/employee_frontlist');
    }

    /*ajax方式查询员工信息*/
    public function listAll() {
        $employeeRs = $this->employeeModel->queryAllEmployee();
        echo json_encode($employeeRs);
    }
    /*前台查询根据主键查询一条员工信息*/
    public function frontshow() {
        $bianhao = input("bianhao");
        $employee = $this->employeeModel->getEmployee($bianhao);
       $this->assign("employee",$employee);
        return $this->fetch("employee/employee_frontshow");
    }

    /*更新员工信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $employee = $this->getEmployeeForm(false);
            $this->uploadPhoto($employee,"zhaopian","zhaopianFile"); //处理照片上传
            try {
                $this->employeeModel->updateEmployee($employee);
                $message = "员工更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "员工更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取员工对象*/
            $bianhao = input("bianhao");
            $employee = $this->employeeModel->getEmployee($bianhao);
            echo json_encode($employee);
        }
    }

    /*删除多条员工记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $bianhaos = input("bianhaos");
        try {
            $count = $this->employeeModel->deleteEmployees($bianhaos);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

