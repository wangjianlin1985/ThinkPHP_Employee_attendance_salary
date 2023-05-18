<?php
namespace app\common\model;
use think\Model;

class SalaryModel extends Model {
    /*关联表名*/
    protected $table  = 't_salary';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    //姓名复合属性的获取: 多对一关系
    public function xingmingF(){
        return $this->belongsTo('EmployeeModel','xingming');
    }

    //部门名称复合属性的获取: 多对一关系
    public function bumenmingchengF(){
        return $this->belongsTo('BumenModel','bumenmingcheng');
    }

    /*添加工资记录*/
    public function addSalary($salary) {
        $this->insert($salary);
    }

    /*更新工资记录*/
    public function updateSalary($salary) {
        $this->update($salary);
    }

    /*删除多条工资信息*/
    public function deleteSalarys($salaryIds){
        $salaryIdArray = explode(",",$salaryIds);
        foreach ($salaryIdArray as $salaryId) {
            $this->salaryId = $salaryId;
            $this->delete();
        }
        return count($salaryIdArray);
    }
    /*根据主键获取工资记录*/
    public function getSalary($salaryId) {
        $salary = SalaryModel::where("salaryId",$salaryId)->find();
        return $salary;
    }

    /*按照查询条件分页查询工资信息*/
    public function querySalary($nianfen, $yuefen, $addtime, $xingming, $bumenmingcheng, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($nianfen != "") $where['nianfen'] = array('like','%'.$nianfen.'%');
        if($yuefen != "") $where['yuefen'] = array('like','%'.$yuefen.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($bumenmingcheng['bumenbianhao'] != "") $where['bumenmingcheng'] = $bumenmingcheng['bumenbianhao'];
        $salaryRs = SalaryModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = SalaryModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $salaryRs;
    }

    /*按照查询条件查询所有工资记录*/
  public function queryOutputSalary( $nianfen,  $yuefen,  $addtime,  $xingming,  $bumenmingcheng) {
        $where = null;
        if($nianfen != "") $where['nianfen'] = array('like','%'.$nianfen.'%');
        if($yuefen != "") $where['yuefen'] = array('like','%'.$yuefen.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($bumenmingcheng['bumenbianhao'] != "") $where['bumenmingcheng'] = $bumenmingcheng['bumenbianhao'];
        $salaryRs = SalaryModel::where($where)->select();
        return $salaryRs;
    }

    /*查询所有工资记录*/
    public function queryAllSalary(){
        $salaryRs = SalaryModel::where(null)->select();
        return $salaryRs;

    }

}
