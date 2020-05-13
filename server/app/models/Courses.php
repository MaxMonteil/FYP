<?php

namespace App\Models;

use App\Core\App;

class Course {
    protected static $table = 'courses';
    public static function newCourse($course) {
        if (is_null($course['CourseName'])) {
            throw new \Exception("please provide the course's name");
        } 
        if (is_null($course['Subject'])) {
            throw new \Exception("please provide the course's subject");
        }
        if (is_null($course['Description'])) {
            throw new \Exception("please provide the course's description");
        }
        if (is_null($course['RecommendedUsers'])) {
            throw new \Exception("please provide recommended users for the course");
        } 
        if (is_null($course['StartDate'])) {
            throw new \Exception("please provide start date for the course");
        }  
        if (is_null($course['EndDate'])) {
            throw new \Exception("please provide end date for the course");
        }  
        if (is_null($course['Price'])) {
            throw new \Exception("please provide course's price");
        }  
        if (is_null($course['Teacher'])) {
            throw new \Exception("please provide a teacher for this course");
        }   
        if (is_null($course['Language'])) {
            throw new \Exception("please state the language used in this course");
        }   
        if (is_null($course['SyllabusName'])) {
            throw new \Exception("please provide syllabus name for this course");
        }   
        App::get('database')->insert(static::$table, $course);
    }

    public static function getCourse($course) {
        $columns = ['CourseID', 'CourseName', 'Subject', 'Description', 'RecommendedUsers', 'StartDate', 'EndDate', 'Price', 'NumOfViewers','Language', 'Teacher', 'SyllabusName'];
        return App::get('database')->selectOne(static::$table, $course, $columns);
    }
    public static function updateCourse($course, $courseID){
        App::get('database')->update(static::$table, $course, ['CourseID'=>$course['CourseID']]);
    }
    // get all courses a certain user is taking (use UserJoinCourse table)
    public static function getCoursesTakenBy($user) {
        $columns1 = ['CourseID'];
        $courses= App::get('database')->selectByAttrValues('userjoincourse', 'UserID',$user['UserID'], $columns1);
        $columns2 = ['CourseID', 'CourseName']; 
        return App::get('database')->selectByAttrValues(static::$table, 'CourseID', $courses['CourseID'], $columns2);
    }

    // get courses by attribute (for example: courses given by certain teacher, or have a certain price, etc. )
    public static function getCourseByAttr($attr, $values){
        $columns = ['CourseID', 'CourseName'];
        return App::get('database')->selectByAttrValues(static::$table, $attr, $values, $columns);
    }
    // getCourseProgress
}