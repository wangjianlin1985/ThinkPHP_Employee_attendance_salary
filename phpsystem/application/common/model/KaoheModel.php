<?php
namespace app\common\model;
use think\Model;

class KaoheModel extends Model {
    /*关联表名*/
    protected $table  = 't_kaohe';
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

    //部门复合属性的获取: 多对一关系
    public function bumenObjF(){
        return $this->belongsTo('BumenModel','bumenObj');
    }

    //考核部门复合属性的获取: 多对一关系
    public function kaohebumenF(){
        return $this->belongsTo('BumenModel','kaohebumen');
    }

    /*添加员工考核记录*/
    public function addKaohe($kaohe) {
        $this->insert($kaohe);
    }

    /*更新员工考核记录*/
    public function updateKaohe($kaohe) {
        $this->update($kaohe);
    }

    /*删除多条员工考核信息*/
    public function deleteKaohes($kaoheIds){
        $kaoheIdArray = explode(",",$kaoheIds);
        foreach ($kaoheIdArray as $kaoheId) {
            $this->kaoheId = $kaoheId;
            $this->delete();
        }
        return count($kaoheIdArray);
    }
    /*根据主键获取员工考核记录*/
    public function getKaohe($kaoheId) {
        $kaohe = KaoheModel::where("kaoheId",$kaoheId)->find();
        return $kaohe;
    }

    /*按照查询条件分页查询员工考核信息*/
    public function queryKaohe($xingming, $bumenObj, $yuefen, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($bumenObj['bumenbianhao'] != "") $where['bumenObj'] = $bumenObj['bumenbianhao'];
        if($yuefen != "") $where['yuefen'] = array('like','%'.$yuefen.'%');
        $kaoheRs = KaoheModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = KaoheModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $kaoheRs;
    }

    /*按照查询条件查询所有员工考核记录*/
  public function queryOutputKaohe( $xingming,  $bumenObj,  $yuefen) {
        $where = null;
        if($xingming['bianhao'] != "") $where['xingming'] = $xingming['bianhao'];
        if($bumenObj['bumenbianhao'] != "") $where['bumenObj'] = $bumenObj['bumenbianhao'];
        if($yuefen != "") $where['yuefen'] = array('like','%'.$yuefen.'%');
        $kaoheRs = KaoheModel::where($where)->select();
        return $kaoheRs;
    }

    /*查询所有员工考核记录*/
    public function queryAllKaohe(){
        $kaoheRs = KaoheModel::where(null)->select();
        return $kaoheRs;

    }

}
