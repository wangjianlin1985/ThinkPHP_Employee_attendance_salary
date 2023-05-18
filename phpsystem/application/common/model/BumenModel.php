<?php
namespace app\common\model;
use think\Model;

class BumenModel extends Model {
    /*关联表名*/
    protected $table  = 't_bumen';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加部门记录*/
    public function addBumen($bumen) {
        $this->insert($bumen);
    }

    /*更新部门记录*/
    public function updateBumen($bumen) {
        $this->update($bumen);
    }

    /*删除多条部门信息*/
    public function deleteBumens($bumenbianhaos){
        $bumenbianhaoArray = explode(",",$bumenbianhaos);
        foreach ($bumenbianhaoArray as $bumenbianhao) {
            $this->bumenbianhao = $bumenbianhao;
            $this->delete();
        }
        return count($bumenbianhaoArray);
    }
    /*根据主键获取部门记录*/
    public function getBumen($bumenbianhao) {
        $bumen = BumenModel::where("bumenbianhao",$bumenbianhao)->find();
        return $bumen;
    }

    /*按照查询条件分页查询部门信息*/
    public function queryBumen($bumenbianhao, $bumenmingcheng, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($bumenbianhao != "") $where['bumenbianhao'] = array('like','%'.$bumenbianhao.'%');
        if($bumenmingcheng != "") $where['bumenmingcheng'] = array('like','%'.$bumenmingcheng.'%');
        $bumenRs = BumenModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = BumenModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $bumenRs;
    }

    /*按照查询条件查询所有部门记录*/
  public function queryOutputBumen( $bumenbianhao,  $bumenmingcheng) {
        $where = null;
        if($bumenbianhao != "") $where['bumenbianhao'] = array('like','%'.$bumenbianhao.'%');
        if($bumenmingcheng != "") $where['bumenmingcheng'] = array('like','%'.$bumenmingcheng.'%');
        $bumenRs = BumenModel::where($where)->select();
        return $bumenRs;
    }

    /*查询所有部门记录*/
    public function queryAllBumen(){
        $bumenRs = BumenModel::where(null)->select();
        return $bumenRs;

    }

}
