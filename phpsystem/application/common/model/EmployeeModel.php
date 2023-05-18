<?php
namespace app\common\model;
use think\Model;

class EmployeeModel extends Model {
    /*关联表名*/
    protected $table  = 't_employee';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    //部门复合属性的获取: 多对一关系
    public function bumenObjF(){
        return $this->belongsTo('BumenModel','bumenObj');
    }

    /*添加员工记录*/
    public function addEmployee($employee) {
        $this->insert($employee);
    }

    /*更新员工记录*/
    public function updateEmployee($employee) {
        $this->update($employee);
    }

    /*删除多条员工信息*/
    public function deleteEmployees($bianhaos){
        $bianhaoArray = explode(",",$bianhaos);
        foreach ($bianhaoArray as $bianhao) {
            $this->bianhao = $bianhao;
            $this->delete();
        }
        return count($bianhaoArray);
    }
    /*根据主键获取员工记录*/
    public function getEmployee($bianhao) {
        $employee = EmployeeModel::where("bianhao",$bianhao)->find();
        return $employee;
    }

    /*按照查询条件分页查询员工信息*/
    public function queryEmployee($bianhao, $xingming, $bumenObj, $danrenzhiwu, $chushengriqi, $shenfenzhenghao, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($bianhao != "") $where['bianhao'] = array('like','%'.$bianhao.'%');
        if($xingming != "") $where['xingming'] = array('like','%'.$xingming.'%');
        if($bumenObj['bumenbianhao'] != "") $where['bumenObj'] = $bumenObj['bumenbianhao'];
        if($danrenzhiwu != "") $where['danrenzhiwu'] = array('like','%'.$danrenzhiwu.'%');
        if($chushengriqi != "") $where['chushengriqi'] = array('like','%'.$chushengriqi.'%');
        if($shenfenzhenghao != "") $where['shenfenzhenghao'] = array('like','%'.$shenfenzhenghao.'%');
        $employeeRs = EmployeeModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = EmployeeModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $employeeRs;
    }

    /*按照查询条件查询所有员工记录*/
  public function queryOutputEmployee( $bianhao,  $xingming,  $bumenObj,  $danrenzhiwu,  $chushengriqi,  $shenfenzhenghao) {
        $where = null;
        if($bianhao != "") $where['bianhao'] = array('like','%'.$bianhao.'%');
        if($xingming != "") $where['xingming'] = array('like','%'.$xingming.'%');
        if($bumenObj['bumenbianhao'] != "") $where['bumenObj'] = $bumenObj['bumenbianhao'];
        if($danrenzhiwu != "") $where['danrenzhiwu'] = array('like','%'.$danrenzhiwu.'%');
        if($chushengriqi != "") $where['chushengriqi'] = array('like','%'.$chushengriqi.'%');
        if($shenfenzhenghao != "") $where['shenfenzhenghao'] = array('like','%'.$shenfenzhenghao.'%');
        $employeeRs = EmployeeModel::where($where)->select();
        return $employeeRs;
    }

    /*查询所有员工记录*/
    public function queryAllEmployee(){
        $employeeRs = EmployeeModel::where(null)->select();
        return $employeeRs;

    }

}
