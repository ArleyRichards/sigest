<?php

namespace Src\Classes;

class ClassRender{

    #Propriedades
    private $Dir;
    private $Title;
    private $Description;
    private $Keywords;
    private $data;
    private $dados;
    private $var1;
    private $var2;
    private $var3;

    public function getDir() { return $this->Dir; }
    public function setDir($Dir) { $this->Dir = $Dir; }
    public function getTitle() { return $this->Title; }
    public function setTitle($Title) { $this->Title = $Title; }
    public function getDescription() { return $this->Description; }
    public function setDescription($Description) { $this->Description = $Description; }
    public function getKeywords() { return $this->Keywords; }
    public function setKeywords($Keywords) { $this->Keywords = $Keywords; }
    public function getData() { return $this->data; }
    public function setData($data) { $this->data = $data; }
    public function getDados() { return $this->dados; }
    public function setDados($dados) { $this->dados = $dados; }
    public function getVar1() { return $this->var1; }
    public function setVar1($var1) { $this->var1 = $var1; }
    public function getVar2() { return $this->var2; }
    public function setVar2($var2) { $this->var2 = $var2; }
    public function getVar3() { return $this->var3; }
    public function setVar3($var3) { $this->var3 = $var3; }

    #Método responsável por renderizar todo o layout
    public function renderLayout()
    {
        include_once(DIRREQ."app/view/layout.php");
    }

    #Adiciona características específicas no head
    public function addHead()
    {
        if(file_exists(DIRREQ."app/view/{$this->getDir()}/Head.php")) {
            include(DIRREQ."app/view/{$this->getDir()}/Head.php");
        }
    }

    #Adiciona características específicas no header
    public function addHeader()
    {
        if(file_exists(DIRREQ."app/view/{$this->getDir()}/Header.php")){
            include(DIRREQ."app/view/{$this->getDir()}/Header.php");
        }
    }

    #Adiciona características específicas no main
    public function addMain()
    {
        if(file_exists(DIRREQ."app/view/{$this->getDir()}/Main.php")){
            include(DIRREQ."app/view/{$this->getDir()}/Main.php");
        }
    }

    #Adiciona características específicas no footer
    public function addFooter()
    {
        if(file_exists(DIRREQ."app/view/{$this->getDir()}/Footer.php")){
            include(DIRREQ."app/view/{$this->getDir()}/Footer.php");
        }
    }
}
?>