<?php
namespace app\common\model;
use think\Model;

class PeixunModel extends Model {
    /*关联表名*/
    protected $table  = 't_peixun';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加公司培训记录*/
    public function addPeixun($peixun) {
        $this->insert($peixun);
    }

    /*更新公司培训记录*/
    public function updatePeixun($peixun) {
        $this->update($peixun);
    }

    /*删除多条公司培训信息*/
    public function deletePeixuns($peixunIds){
        $peixunIdArray = explode(",",$peixunIds);
        foreach ($peixunIdArray as $peixunId) {
            $this->peixunId = $peixunId;
            $this->delete();
        }
        return count($peixunIdArray);
    }
    /*根据主键获取公司培训记录*/
    public function getPeixun($peixunId) {
        $peixun = PeixunModel::where("peixunId",$peixunId)->find();
        return $peixun;
    }

    /*按照查询条件分页查询公司培训信息*/
    public function queryPeixun($mingcheng, $shijian, $didian, $addtime, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($mingcheng != "") $where['mingcheng'] = array('like','%'.$mingcheng.'%');
        if($shijian != "") $where['shijian'] = array('like','%'.$shijian.'%');
        if($didian != "") $where['didian'] = array('like','%'.$didian.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        $peixunRs = PeixunModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = PeixunModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $peixunRs;
    }

    /*按照查询条件查询所有公司培训记录*/
  public function queryOutputPeixun( $mingcheng,  $shijian,  $didian,  $addtime) {
        $where = null;
        if($mingcheng != "") $where['mingcheng'] = array('like','%'.$mingcheng.'%');
        if($shijian != "") $where['shijian'] = array('like','%'.$shijian.'%');
        if($didian != "") $where['didian'] = array('like','%'.$didian.'%');
        if($addtime != "") $where['addtime'] = array('like','%'.$addtime.'%');
        $peixunRs = PeixunModel::where($where)->select();
        return $peixunRs;
    }

    /*查询所有公司培训记录*/
    public function queryAllPeixun(){
        $peixunRs = PeixunModel::where(null)->select();
        return $peixunRs;

    }

}
