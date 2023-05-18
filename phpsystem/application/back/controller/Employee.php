<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\BumenModel;
use app\common\model\EmployeeModel;

class Employee extends BackBase {
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
    public function add(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $employee = $this->getEmployeeForm(true);
            $this->uploadPhoto($employee,"zhaopian","zhaopianFile"); //处理照片上传
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
            return view('employee/employee_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("bianhao",input("bianhao"));
        return view("employee/employee_modify");
    }

    /*ajax方式按照查询条件分页查询员工信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->employeeModel->setRows($this->request->param("rows"));
            $bianhao = input("bianhao")==null?"":input("bianhao");
            $xingming = input("xingming")==null?"":input("xingming");
            $bumenObj["bumenbianhao"] = input("bumenObj_bumenbianhao")==null?"":input("bumenObj_bumenbianhao");
            $danrenzhiwu = input("danrenzhiwu")==null?"":input("danrenzhiwu");
            $chushengriqi = input("chushengriqi")==null?"":input("chushengriqi");
            $shenfenzhenghao = input("shenfenzhenghao")==null?"":input("shenfenzhenghao");
            $employeeRs = $this->employeeModel->queryEmployee($bianhao, $xingming, $bumenObj, $danrenzhiwu, $chushengriqi, $shenfenzhenghao, $this->currentPage);
            $expTableData = [];
            foreach($employeeRs as $employeeRow) {
                $employeeRow["bumenObj"] = $this->bumenModel->getBumen($employeeRow["bumenObj"])["bumenmingcheng"];
                $expTableData[] = $employeeRow;
            }
            $data["rows"] = $employeeRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->employeeModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("employee/employee_query");
        }
    }

    /*ajax方式查询员工信息*/
    public function listAll() {
        $employeeRs = $this->employeeModel->queryAllEmployee();
        echo json_encode($employeeRs);
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

    /*按照查询条件导出员工信息到Excel*/
    public function outToExcel() {
        $bianhao = input("bianhao")==null?"":input("bianhao");
        $xingming = input("xingming")==null?"":input("xingming");
        $bumenObj["bumenbianhao"] = input("bumenObj_bumenbianhao")==null?"":input("bumenObj_bumenbianhao");
        $danrenzhiwu = input("danrenzhiwu")==null?"":input("danrenzhiwu");
        $chushengriqi = input("chushengriqi")==null?"":input("chushengriqi");
        $shenfenzhenghao = input("shenfenzhenghao")==null?"":input("shenfenzhenghao");
        $employeeRs = $this->employeeModel->queryOutputEmployee($bianhao,$xingming,$bumenObj,$danrenzhiwu,$chushengriqi,$shenfenzhenghao);
        $expTableData = [];
        foreach($employeeRs as $employeeRow) {
            $employeeRow["bumenObj"] = $this->bumenModel->getBumen($employeeRow["bumenObj"])["bumenmingcheng"];
            $expTableData[] = $employeeRow;
        }
        $xlsName = "Employee";
        $xlsCell = array(
            array('bianhao','员工编号','string'),
            array('xingming','姓名','string'),
            array('xingbie','性别','string'),
            array('bumenObj','部门','string'),
            array('danrenzhiwu','担任职务','string'),
            array('minzu','民族','string'),
            array('chushengriqi','出生日期','string'),
            array('shenfenzhenghao','身份证号','string'),
            array('jiguan','籍贯','string'),
            array('zhaopian','照片','photo'),
            array('addtime','添加时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

