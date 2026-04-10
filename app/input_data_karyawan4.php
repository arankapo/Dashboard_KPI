

    <div class="container-fluid">
        <div class=" row justify-content-md-center">

            <div class="col-md-6">
                <br>
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Combobox Bertingkat</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">ClasCode | iniilmu.com</h6>
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Provinsi</label>
                                <select class="form-control" id="id_departemen">
                                    <option>---Pilih Provinsi---</option>
                                    <?php
                                        $sql = mysqli_query($koneksi,"SELECT * FROM tb_dept order by nama_dept ASC") or die(mysqli_error($con));
                                        while ($dt = mysqli_fetch_array($sql)) {
                                    ?>
                                        <option value="<?php echo $dt['Id_dept'] ?>"><?php echo $dt['nama_dept'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kabupaten</label>
                                <select class="form-control" id="id_kabupaten">
                                    <option>---Pilih Kabupaten---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kecamatan</label>
                                <select class="form-control" id="id_kecamatan">
                                    <option>---Pilih Kecamatan---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kelurhan/Desa</label>
                                <select class="form-control" id="id_kelurahan">
                                    <option>---Pilih Kelurahan---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('#id_departemen').on('change',function(){
                var id_provinsi = $(this).val();
                $.ajax({
                    url:'ambil_data.php',
                    type:"POST",
                    data:{
                        modul:'Kabupaten',
                        id:id_provinsi
                    },
                    success:function(respond){
                        $("#id_kabupaten").html(respond);
                    },
                    error:function(){
                        alert("Gagal Mengambil Data");
                    }
                })
            })

           
        });

    </script>



