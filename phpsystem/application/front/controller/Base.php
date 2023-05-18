<?php
namespace app\front\controller;
use think\Controller;

class Base extends Controller
{
    protected $currentPage = 1;
    protected $request = null;

    //向客户端输出ajax响应结果
    public function writeJsonResponse($success, $message) {
        $response = array(
            "success" => $success,
            "message" => $message,
        );
        echo json_encode($response);
    }

    /**
     * @param $obj:  保存图片路径的对象
     * @param $indexName 索引名称
     * @param $photoFiledName 提交的图片表单名称
     */
    public function uploadPhoto(&$obj,$indexName,$photoFiledName) {
        if($_FILES[$photoFiledName]['tmp_name']){
            $file = $this->request->file($photoFiledName);
            //控制上传的文件类型，大小
            if(!(($_FILES[$photoFiledName]["type"]=="image/jpeg"
                    || $_FILES[$photoFiledName]["type"]=="image/jpg"
                    || $_FILES[$photoFiledName]["type"]=="image/png") && $_FILES[$photoFiledName]["size"] < 1024000)) {
                $message = "图书图片请选择jpg或png格式的图片!";
                $this->writeJsonResponse(false,$message);
                exit;
            }
            $file->setRule("short"); //文件路径采用简短方式
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            $obj[$indexName]='upload/'.$info->getSaveName();
        }
    }

    /**
     * @param $obj:  保存文件路径的对象
     * @param $indexName 索引名称
     * @param $resourceFiledName 提交的文件表单名称
     */
    public function uploadFile(&$obj,$indexName,$resourceFiledName) {
        if($_FILES[$resourceFiledName]['tmp_name']){
            $file = $this->request->file($resourceFiledName);
            $file->setRule("short"); //文件路径采用简短方式
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            $obj[$indexName]='upload/'.$info->getSaveName();
        }
    }

    //接收提交的Bumen信息参数
    public function getBumenForm($insertFlag) {
        $bumen = [
            'bumenbianhao'=> input("bumen_bumenbianhao"), //部门编号
            'bumenmingcheng'=> input("bumen_bumenmingcheng"), //部门名称
            'addtime'=> input("bumen_addtime"), //添加时间
        ];
        return $bumen;
    }

    //接收提交的Employee信息参数
    public function getEmployeeForm($insertFlag) {
        $employee = [
            'bianhao'=> input("employee_bianhao"), //员工编号
            'mima'=> input("employee_mima"), //密码
            'xingming'=> input("employee_xingming"), //姓名
            'xingbie'=> input("employee_xingbie"), //性别
            'bumenObj'=> input("employee_bumenObj_bumenbianhao"), //部门
            'danrenzhiwu'=> input("employee_danrenzhiwu"), //担任职务
            'minzu'=> input("employee_minzu"), //民族
            'chushengriqi'=> input("employee_chushengriqi"), //出生日期
            'shenfenzhenghao'=> input("employee_shenfenzhenghao"), //身份证号
            'jiguan'=> input("employee_jiguan"), //籍贯
            'wenhuachengdu'=> input("employee_wenhuachengdu"), //文化程度
            'zhengzhimianmao'=> input("employee_zhengzhimianmao"), //政治面貌
            'hunyinqingkuang'=> input("employee_hunyinqingkuang"), //婚姻状况
            'biyeyuanxiao'=> input("employee_biyeyuanxiao"), //毕业院校
            'zhuanye'=> input("employee_zhuanye"), //专业
            'biyeshijian'=> input("employee_biyeshijian"), //毕业时间
            'shoujihao'=> input("employee_shoujihao"), //手机号
            'jibengongzi'=> input("employee_jibengongzi"), //基本工资
            'xianzhuzhi'=> input("employee_xianzhuzhi"), //现住址
            'zhaopian' => $insertFlag==true?"upload/NoImage.jpg":input("employee_zhaopian"), //照片
            'beizhu'=> input("employee_beizhu"), //备注
            'addtime'=> input("employee_addtime"), //添加时间
        ];
        return $employee;
    }

    //接收提交的Diaodong信息参数
    public function getDiaodongForm($insertFlag) {
        $diaodong = [
            'id'=> input("diaodong_id"), //调动id
            'xingming'=> input("diaodong_xingming_bianhao"), //姓名
            'bumenmingcheng'=> input("diaodong_bumenmingcheng_bumenbianhao"), //部门名称
            'danrenzhiwu'=> input("diaodong_danrenzhiwu"), //担任职务
            'yuanjibengongzi'=> input("diaodong_yuanjibengongzi"), //原基本工资
            'diaodongzhiwei'=> input("diaodong_diaodongzhiwei"), //调动职位
            'diaodongbumen'=> input("diaodong_diaodongbumen_bumenbianhao"), //调动部门
            'diaodongriqi'=> input("diaodong_diaodongriqi"), //调动日期
            'xianjibengongzi'=> input("diaodong_xianjibengongzi"), //现基本工资
            'diaodongyuanyin'=> input("diaodong_diaodongyuanyin"), //调动原因
            'addtime'=> input("diaodong_addtime"), //添加时间
        ];
        return $diaodong;
    }

    //接收提交的Salary信息参数
    public function getSalaryForm($insertFlag) {
        $salary = [
            'salaryId'=> input("salary_salaryId"), //工资id
            'xingming'=> input("salary_xingming_bianhao"), //姓名
            'bumenmingcheng'=> input("salary_bumenmingcheng_bumenbianhao"), //部门名称
            'danrenzhiwu'=> input("salary_danrenzhiwu"), //担任职务
            'nianfen'=> input("salary_nianfen"), //年份
            'yuefen'=> input("salary_yuefen"), //月份
            'jibengongzi'=> input("salary_jibengongzi"), //基本工资
            'quanqinjiangli'=> input("salary_quanqinjiangli"), //全勤奖励
            'kaohejiangli'=> input("salary_kaohejiangli"), //考核奖励
            'jiabangongzi'=> input("salary_jiabangongzi"), //加班工资
            'jintiebuzhu'=> input("salary_jintiebuzhu"), //津贴补助
            'chengfajine'=> input("salary_chengfajine"), //惩罚金额
            'gerensuodeshui'=> input("salary_gerensuodeshui"), //个人所得税
            'wuxianyijin'=> input("salary_wuxianyijin"), //五险一金
            'yingfagongzi'=> input("salary_yingfagongzi"), //应发工资
            'shifagongzi'=> input("salary_shifagongzi"), //实发工资
            'beizhu'=> input("salary_beizhu"), //备注
            'addtime'=> input("salary_addtime"), //添加时间
        ];
        return $salary;
    }

    //接收提交的Kaohe信息参数
    public function getKaoheForm($insertFlag) {
        $kaohe = [
            'kaoheId'=> input("kaohe_kaoheId"), //考核id
            'xingming'=> input("kaohe_xingming_bianhao"), //姓名
            'bumenObj'=> input("kaohe_bumenObj_bumenbianhao"), //部门
            'zhiwu'=> input("kaohe_zhiwu"), //职务
            'nianfen'=> input("kaohe_nianfen"), //年份
            'yuefen'=> input("kaohe_yuefen"), //月份
            'kaohejieguo'=> input("kaohe_kaohejieguo"), //考核结果
            'kaohejiangli'=> input("kaohe_kaohejiangli"), //考核奖励
            'kaohebumen'=> input("kaohe_kaohebumen_bumenbianhao"), //考核部门
            'kaoheren'=> input("kaohe_kaoheren"), //考核人
            'kaoheneirong'=> input("kaohe_kaoheneirong"), //考核内容
            'addtime'=> input("kaohe_addtime"), //添加时间
        ];
        return $kaohe;
    }

    //接收提交的Kaoqin信息参数
    public function getKaoqinForm($insertFlag) {
        $kaoqin = [
            'kaoqinId'=> input("kaoqin_kaoqinId"), //考勤id
            'xingming'=> input("kaoqin_xingming_bianhao"), //姓名
            'xingbie'=> input("kaoqin_xingbie"), //性别
            'suoshubumen'=> input("kaoqin_suoshubumen_bumenbianhao"), //所属部门
            'danrenzhiwu'=> input("kaoqin_danrenzhiwu"), //担任职务
            'nianfen'=> input("kaoqin_nianfen"), //年份
            'yuefen'=> input("kaoqin_yuefen"), //月份
            'daoqintianshu'=> input("kaoqin_daoqintianshu"), //到勤天数
            'chidaotianshu'=> input("kaoqin_chidaotianshu"), //迟到天数
            'kuangdaotianshu'=> input("kaoqin_kuangdaotianshu"), //旷工天数
            'qingjiatianshu'=> input("kaoqin_qingjiatianshu"), //请假天数
            'beizhu'=> input("kaoqin_beizhu"), //备注
            'addtime'=> input("kaoqin_addtime"), //添加时间
        ];
        return $kaoqin;
    }

    //接收提交的Peixun信息参数
    public function getPeixunForm($insertFlag) {
        $peixun = [
            'peixunId'=> input("peixun_peixunId"), //培训id
            'mingcheng'=> input("peixun_mingcheng"), //培训名称
            'shijian'=> input("peixun_shijian"), //培训时间
            'qingdan'=> input("peixun_qingdan"), //培训清单
            'didian'=> input("peixun_didian"), //培训地点
            'addtime'=> input("peixun_addtime"), //添加时间
        ];
        return $peixun;
    }

}

