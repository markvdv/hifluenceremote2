<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Taxonomy\Service;

/**
 * Description of tagservice
 *
 * @author mark
 */
class TagService {
/**
 * 
 * @return array an array of all tags
 */
    public static function getTagList() {
        return \Taxonomy\DAO\TagDAO::getAll();
    }
/**
 * creates a tag if it doesnt exist yet and also creates a link
 * @param string $tagname
 * @param int $entityid
 * @param int $entitytype
 * @return boolean
 */
    public static function createTag($tagname, $entityid, $entitytype) {
        $tag = \Taxonomy\DAO\TagDAO::getByName($tagname);
        if (!$tag) {
            $tagid = \Taxonomy\DAO\TagDAO::insert($tagname);
        } else {
            $tagid = $tag->getTagid();
        }
        \Taxonomy\DAO\TagDAO::createTaglink($tagid, $entityid, $entitytype);
        return true;
    }
/**
 * creates a link between a tag and entity in the database
 * @param int $tagid
 * @param int $entityid
 * @return  int id of the last inserted (which although inserting always returns 0)
 */
    public static function linkTag($tagid, $entityid) {
        return \Taxonomy\DAO\TagDAO::createTaglink($tagid, $entityid, "user");
    }

}
