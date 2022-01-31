<?php

interface IDAO{
    public function find($id);
    public function findAll();
    public function save($obj);
    public function update($obj);
    public function delete($id);
}