<?php
/**
 * Created by PhpStorm.
 * User: s7016516
 * Date: 2018/10/29
 * Time: 15:27
 */

class ProLang
{
    private $id;
    private $name;
    private $writer;
    private $developer;
    private $extension;
    private $like;
    private $comment;

    /**
     * ProLang constructor.
     * @param $id
     * @param $name
     * @param $writer
     * @param $developer
     * @param $extension
     * @param $like
     * @param $comment
     */
    public function __construct($id, $name, $writer, $developer, $extension, $like, $comment)
    {
        $this->id = $id;
        $this->name = $name;
        $this->writer = $writer;
        $this->developer = $developer;
        $this->extension = $extension;
        $this->like = $like;
        $this->comment = $comment;
    }

    public function getMembers()
    {
        $array = array();

        array_push($array, $this->id);
        array_push($array, $this->name);
        array_push($array, $this->writer);
        array_push($array, $this->developer);
        array_push($array, $this->extension);
        array_push($array, $this->like);
        array_push($array, $this->comment);

        return $array;
    }

    public function callComp($type)
    {
        try {
            return $this->$type();
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function toText()
    {
        $deli = '|';
        $text = $this->id . $deli . $this->name . $deli . $this->writer . $deli . $this->developer . $deli . $this->extension . $deli . $this->like . $deli . $this->comment;
        return $text;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @param mixed $writer
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;
    }

    /**
     * @return mixed
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * @param mixed $developer
     */
    public function setDeveloper($developer)
    {
        $this->developer = $developer;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return mixed
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * @param mixed $like
     */
    public function setLike($like)
    {
        $this->like = $like;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
}