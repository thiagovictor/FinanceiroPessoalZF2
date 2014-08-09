<?php

namespace Financeiro\ClassesExtras;

class RepositoryFile {

    protected $filename;
    protected $full_file_name;
    protected $ext;
    protected $size;
    protected $download;

    public function __construct($file) {
        $base = pathinfo($file);
        $this->filename = $base["basename"];
        $this->full_file_name = $file;
        $this->ext = $base["extension"];
        $this->size = filesize($file);
        $this->download = false;
    }

    private function setHeader() {
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: {$this->getContentType()}");
        header("Content-length: {$this->size}");
        $attachment = "";
        if ($this->download) {
            $attachment = "attachment;";
        }
        header("Content-Disposition: {$attachment} filename={$this->filename}");
    }

    private function getContentType() {
        switch ($this->ext) {
            case "pdf":
                return "application/pdf";
            case "png":
                return "image/png";
            case "jpeg":
                return "image/jpg";
            case "jpg":
                return "image/jpg";
            default:
                $this->download = true;
                return "application/force-download";
        }
    }

    public function getArquivo() {
        $this->setHeader();
        $handle = fopen($this->full_file_name, "rb");
        $conteudo = fread($handle, $this->size);
        fclose($handle);
        return $conteudo;
    }
    
    public function getFilename() {
        return $this->filename;
    }

    public function getFull_file_name() {
        return $this->full_file_name;
    }

    public function getExt() {
        return $this->ext;
    }

    public function getSize() {
        return $this->size;
    }

    public function getDownload() {
        return $this->download;
    }
}

//echo (new RepositoryFile("../arquivos/doc.pdf"))->getArquivo();