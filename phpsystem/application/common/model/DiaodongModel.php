<?php
namespace app\common\model;
use think\Model;

class DiaodongModel extends Model {
    /*关联表名*/
    protected $table  = 't_diaodong';
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

    //调动部门复合属性的获取: 多对一关系
    public function diaodongbumenF(){
        return $this->belongsTo('BumenModel','diaodongbumen');
    }

    /*添加员工调动记录*/
    public function addDiaodong($diaodong) {
        $this->insert($diaodong);
    }

    /*更新员工调动记录*/
    public function updateDiaodong($diaodong) {
        $this->update($diaodong);
    }

    /*删除多条员工调动信息*/
    public function deleteDiaodongs($ids){
        $idArray = explode(",",$ids);
        foreach ($idArray as $id) {
            $this->id = $id;
            $this->delete();
        }
        return count($idArray);
    }
    /*根据主键获取员工调动记录*/
    public function getDiaodong($id) {
        $diaodong = DiaodongModel::where("id",$id)->find();
        return $diaodong;
    }

    /*按照查询条件分页查询员工调动信息*/
    public function queryDiaodong($xingming, $diaodongriqi, $diaodongyuanyin, $addtime, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($diaodongriqi != "") $where['diaodongriqi'] = array('like','%'.$diaodongriqi.'%');
        if($diaodongyuanyin != "") $where['diaodongyuanyin'] = array('like','%'.$diaodongyuanyin.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        $diaodongRs = DiaodongModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = DiaodongModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $diaodongRs;
    }

    /*按照查询条件查询所有员工调动记录*/
  public function queryOutputDiaodong( $xingming,  $diaodongriqi,  $diaodongyuanyin,  $addtime) {
        $where = null;
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($diaodongriqi != "") $where['diaodongriqi'] = array('like','%'.$diaodongriqi.'%');
        if($diaodongyuanyin != "") $where['diaodongyuanyin'] = array('like','%'.$diaodongyuanyin.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        $diaodongRs = DiaodongModel::where($where)->select();
        return $diaodongRs;
    }

    /*查询所有员工调动记录*/
    public function queryAllDiaodong(){
        $diaodongRs = DiaodongModel::where(null)->select();
        return $diaodongRs;

    }

}
