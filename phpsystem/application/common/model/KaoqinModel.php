<?php
namespace app\common\model;
use think\Model;

class KaoqinModel extends Model {
    /*关联表名*/
    protected $table  = 't_kaoqin';
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

    //所属部门复合属性的获取: 多对一关系
    public function suoshubumenF(){
        return $this->belongsTo('BumenModel','suoshubumen');
    }

    /*添加员工考勤记录*/
    public function addKaoqin($kaoqin) {
        $this->insert($kaoqin);
    }

    /*更新员工考勤记录*/
    public function updateKaoqin($kaoqin) {
        $this->update($kaoqin);
    }

    /*删除多条员工考勤信息*/
    public function deleteKaoqins($kaoqinIds){
        $kaoqinIdArray = explode(",",$kaoqinIds);
        foreach ($kaoqinIdArray as $kaoqinId) {
            $this->kaoqinId = $kaoqinId;
            $this->delete();
        }
        return count($kaoqinIdArray);
    }
    /*根据主键获取员工考勤记录*/
    public function getKaoqin($kaoqinId) {
        $kaoqin = KaoqinModel::where("kaoqinId",$kaoqinId)->find();
        return $kaoqin;
    }

    /*按照查询条件分页查询员工考勤信息*/
    public function queryKaoqin($xingming, $suoshubumen, $nianfen, $yuefen, $addtime, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($suoshubumen['bumenbianhao'] != "") $where['suoshubumen'] = $suoshubumen['bumenbianhao'];
        if($nianfen != "") $where['nianfen'] = array('like','%'.$nianfen.'%');
        if($yuefen != "") $where['yuefen'] = array('like','%'.$yuefen.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        $kaoqinRs = KaoqinModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = KaoqinModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $kaoqinRs;
    }

    /*按照查询条件查询所有员工考勤记录*/
  public function queryOutputKaoqin( $xingming,  $suoshubumen,  $nianfen,  $yuefen,  $addtime) {
        $where = null;
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($suoshubumen['bumenbianhao'] != "") $where['suoshubumen'] = $suoshubumen['bumenbianhao'];
        if($nianfen != "") $where['nianfen'] = array('like','%'.$nianfen.'%');
        if($yuefen != "") $where['yuefen'] = array('like','%'.$yuefen.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        $kaoqinRs = KaoqinModel::where($where)->select();
        return $kaoqinRs;
    }

    /*查询所有员工考勤记录*/
    public function queryAllKaoqin(){
        $kaoqinRs = KaoqinModel::where(null)->select();
        return $kaoqinRs;

    }

}
