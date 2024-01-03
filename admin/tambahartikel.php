<?php 
include('template/header.php')
?>

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Tambah Artikel</h4>
<form action="request/createartikel.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Artikel</h5>
            <a href="tambahartikel.php" class="btn btn-info float-end">Kembali ke Beranda </a>
        </div>
        <div class="card-body">
            <form>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Judul</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="basic-default-name" name="title" placeholder="Input Judul" required/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="formFile" class="col-sm-2 col-form-label">Cover Image</label>
                <div class="col-sm-10">
                <input class="form-control" type="file" id="formFile" name="cover"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-message" >Artikel</label>
                <div class="col-sm-10">
                <textarea
                    id="trumbowyg-demo"
                    class="form-control"
                    placeholder="Hi, Do you have a moment to talk Joe?"
                    aria-label="Hi, Do you have a moment to talk Joe?"
                    aria-describedby="basic-icon-default-message2"
                    name="body"
                ></textarea>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-10">
                <input type="submit" name="submit" value ="Publish" class="btn btn-primary">
                <input type="submit" name="submit" value ="Save to Draft" class="btn btn-light ">
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
</form>
</div>


<?php 
include('template/footer.php')
?>

