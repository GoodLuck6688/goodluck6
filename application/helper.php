<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11/011
 * Time: 17:38
 */
if (!function_exists('getConfigGroup')) {

    /**
     * 获取配置组信息
     * @param string $dirname 目录
     * @param bool $withself 是否删除自身
     * @return boolean
     */
    function getConfigGroup($group='basic',$sort='ASC') {
        $groupList = db('config')
            ->where(['group'=>$group])
            ->order('id ASC')
            ->select();
        return $groupList;
    }

}
if (!function_exists('getCategoryList')) {

    /**
     * 获取配置组信息
     * @param string $dirname 目录
     * @param bool $withself 是否删除自身
     * @return boolean
     */
    function getCategoryList($type='page',$pid=0,$limit =5,$field='weigh',$sort='ASC') {
        $List = db('category')
            ->where(['pid'=>$pid,'type'=>$type])
            ->order("$field $sort")
            ->limit($limit)
            ->select();
        return $List;
    }

}