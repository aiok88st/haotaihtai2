<?php
namespace file;
define('FILE_ROOT', dirname(__FILE__) . '/');
use think\Config;
class model{
    // 错误信息
    public $error;
    public function add($data){
        $model_sql=file_get_contents(FILE_ROOT . 'sql/sql.sql');
        $prefix=Config::get('database.prefix');
        $model_sql = str_replace('$basic_table', $prefix.$data['dataname'], $model_sql);
        if(db()->execute($model_sql)!==false){
            //建完表去建配置文件。
            $file=FILE_ROOT."config/model_".$data['id'].".php";
            $config=$this->config();
            file_put_contents($file,$config);
            return true;
        }else{
            $this->error="新建数据表失败";
            return false;
        }

    }
    public function get_config($model_id){
        $filename=FILE_ROOT."config/model_".$model_id.".php";
        return include_once $filename;
    }

    public function get_system(){
        $filename=FILE_ROOT."system.php";
        return include_once $filename;
    }
    public function get_search($data,$filedname){
        if(isset($data[$filedname])){
            return $data[$filedname];
        }else{
            return false;
        }

    }
    public function put_config($data,$id){
      $config="<?php "."\r\n";
      $config .=" return array("."\r\n";
      foreach ($data as $keys=>$values){
          $config .="'".$keys."'=>[";
          $config .="\r\n";
          foreach ($values as $key=>$value){
              $v=(!empty($value)|$value==0)?$value:"''";
              $config .="\t\t'".$key."'=>'".$v."',"."\r\n";
          }
          $config .=" ],"."\r\n";
      }
        $config .=")"."\r\n";
        $config .="?>";
        $file=FILE_ROOT."config/model_".$id.".php";
        $file_k=file_put_contents($file,$config);
        return $file_k;
    }
    public function get_file($modeId,$id=""){
        $filename=FILE_ROOT."config/model_".$modeId.".php";
        $config=include_once $filename;
        $config=TwoArraySorting($config,'listorder',SORT_ASC);
        $html="";
        $temp = time();
        $token = md5($temp);
        $uploadUrl=url('Material/uploadimg?parent_id=0',array('token'=>$token,'temp'=>$temp,'shape'=>'','savePath'=>'content'));
        $filesUrl=url('Material/files',array('token'=>$token,'temp'=>$temp));
        $layeditupload=url('Material/layedit',array('token'=>$token,'temp'=>$temp));

        if(!empty($id)){
            $dataname=db('model')->where(['id'=>$modeId])->value('dataname');

            define('DB_NAME',$dataname);
            $ContentModel=new \app\admin\model\ContentModel;
            $data=$ContentModel::get($id);
            $data=json_decode(json_encode($data));
            $data=toArray($data);
        }
        foreach ($config as $key=>$value){
            $filename=FILE_ROOT."file/".$value['type'].".tpl";
            $html .=include $filename;
        }

    }
    private function config($data=""){
        $content=<<<HEAD
<?php 
   return array(
      'title'=>[
        'listorder'=>1,
        'name'=>'标题',
        'minleng'=>1,
        'maxleng'=>80,
        'style'=>'',
        'type'=>'text',
        'unique'=>0, //是否唯一 1：是，0否。
        'regex'=>'', //正则验证。
        'default'=>''
      ],
       'thumb'=>[
        'listorder'=>2,
        'name'=>'缩略图',
        'minleng'=>0,
        'maxleng'=>255,
        'style'=>'',
        'type'=>'img',
        'unique'=>0, //是否唯一 1：是，0否。
        'regex'=>'', //正则验证。
        'default'=>'' 
       ],
       'keywords'=>[
        'listorder'=>3,
        'name'=>'关键字',
        'minleng'=>0,
        'maxleng'=>255,
        'style'=>'',
        'type'=>'text',
        'unique'=>0, //是否唯一 1：是，0否。
        'regex'=>'', //正则验证。
        'default'=>''
       ],
       'description'=>[
        'listorder'=>4,
        'name'=>'简介',
        'minleng'=>0,
        'maxleng'=>255,
        'style'=>'',
        'type'=>'textarea',
        'unique'=>0, //是否唯一 1：是，0否。
        'regex'=>'', //正则验证。
        'default'=>'' 
       ], 
       'content'=>[
        'listorder'=>5, 
        'name'=>'内容',
        'minleng'=>0,
        'maxleng'=>9999,
        'style'=>'',
        'type'=>'layedit',
        'unique'=>0, //是否唯一 1：是，0否。
        'regex'=>'', //正则验证。
        'default'=>''
       ]
   )     
        
?>
HEAD;
    return $content;
    }
}
?>