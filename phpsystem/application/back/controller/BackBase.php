<?php
namespace app\back\controller;
use think\Controller;

class BackBase extends Controller
{
    protected $currentPage = 1;
    protected $request = null;

    public function _initialize(){
        if(!session('username')){
            $this->error('请先登录系统！','Login/index');
        }
    }

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

    /** * 公共数据导出实现功能
     * @param $expTitle 导出文件名
     * @param $expCellName 导出文件列名称
     * @param $expTableData 导出数据
     */
    public function export_excel($expTitle,$expCellName,$expTableData) {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $expTitle . date('_Ymd');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        //这些文件需要下载phpexcel，然后放在vendor文件里面。具体参考上一篇数据导出。
        vendor("PHPExcel.PHPExcel");
        //vendor("PHPExcel.PHPExcel.Writer.IWriter");
        //vendor("PHPExcel.PHPExcel.Writer.Abstract");
        //vendor("PHPExcel.PHPExcel.Writer.Excel5");
        //vendor("PHPExcel.PHPExcel.Writer.Excel2007");
        vendor("PHPExcel.PHPExcel.IOFactory");
        $objPHPExcel = new \PHPExcel();//方法一
        $cellName = array('A','B', 'C','D', 'E', 'F','G','H','I', 'J', 'K','L','M', 'N', 'O', 'P', 'Q','R','S', 'T','U','V', 'W', 'X','Y', 'Z', 'AA',    'AB', 'AC','AD','AE', 'AF','AG','AH','AI', 'AJ', 'AK', 'AL','AM','AN','AO','AP','AQ','AR', 'AS', 'AT','AU', 'AV','AW', 'AX', 'AY', 'AZ');
        //设置头部导出时间备注
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');//合并单元格
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle . ' 导出时间:' . date('Y-m-d H:i:s'));
        //设置列名称
        for ($i = 0; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellName[$i])->setWidth(20); //设置每列宽度
            $objPHPExcel->getActiveSheet()->getStyle($cellName[$i].'2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($cellName[$i])->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直居中对齐
        }
        //赋值
        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet()->getStyle($cellName[$j].($i + 3))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                if($expCellName[$j][2] == 'photo') {
                    try {
                        // 表格高度
                        $objPHPExcel->getActiveSheet()->getRowDimension($i+3)->setRowHeight(80);
                        // 图片生成
                        $objDrawing = new \PHPExcel_Worksheet_Drawing();
                        $objDrawing->setPath(PUBLIC_PATH.$expTableData[$i][$expCellName[$j][0]]);
                        // 设置宽度高度
                        $objDrawing->setHeight(80);//照片高度
                        $objDrawing->setWidth(80); //照片宽度
                        /*设置图片要插入的单元格*/
                        $objDrawing->setCoordinates($cellName[$j].($i + 3));
                        // 图片偏移距离
                        $objDrawing->setOffsetX(5);
                        $objDrawing->setOffsetY(5);
                        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                    } catch (\Exception $ex) {}
                } else {
                    $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i + 3), $expTableData[$i][$expCellName[$j][0]]);
                }
            }
        }
        ob_end_clean();//这一步非常关键，用来清除缓冲区防止导出的excel乱码
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//"xls"参考下一条备注
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'  );//"Excel2007"生成2007版本的xlsx，"Excel5"生成2003版本的xls
        $objWriter->save('php://output');
    }
}

