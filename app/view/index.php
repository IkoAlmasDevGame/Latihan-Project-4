<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toko</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"> -->
    <style type="text/css">
    body {
        background: rgba(100, 100, 100, 0.85);
        font-size: medium;
        font-family: sans-serif;
        font-weight: normal;
        font-style: normal;
    }
    </style>
    <?php 
        require_once("../database/koneksi.php");
        if(!empty($_GET['act']=="register")){
            if(isset($_POST['submit'])){
                $email = htmlspecialchars($_POST['email']);
                $username = htmlspecialchars($_POST['username']);
                $password = password_verify(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
                $nama = htmlspecialchars($_POST['nama']);
                $jabatan = htmlspecialchars($_POST['user_level']);
                
                $table = "tbl_pengguna";
                $sql = "INSERT INTO $table (email,username,password,nama,user_level) VALUES (?,?,?,?,?)";
                $row = $configs->prepare($sql);
                $row->execute(array($email,$username,$password,$nama,$jabatan));
                header("location:index.php");
                exit(0);
            }
        }
    ?>
</head>

<body onload="startTime()">
    <div class="layout">
        <div class="layoutApp">
            <div class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a href="index.php" class="navbar-brand">
                        Toko Penyimpanan Barang
                    </a>
                    <button type="button" class="navbar-toggler" aria-controls="navbarSupportToggle"
                        data-bs-target="#navbarSupportToggle" data-bs-toggle="collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportToggle">
                        <ul class="navbar-nav ms-auto mx-3 mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="index.php" aria-current="page" class="nav-link hover">Beranda</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-wrap pt-5 mt-5">
                <div class="card" style="min-width: 50%; width:496px;">
                    <div class="card-header">
                        <div class="card-title text-center">
                            <h4 class="display-6">Login Dashboard Penyimpanan Barang</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="act-pengguna.php" method="post">
                            <div class="row form-group input-group
                                    d-flex justify-content-center align-items-center flex-wrap">
                                <div class="col-md-10 col-lg-10">
                                    <div class="input-group-addon">
                                        <label for="userInput">Email atau username</label>
                                        <div class="input-group-text">
                                            <input type="text" name="userEmail" id="userInput" class="form-control"
                                                placeholder="Masukkan Email atau Username ..." required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2"></div>
                            <div class="row form-group input-group 
                                    d-flex justify-content-center align-items-center flex-wrap">
                                <div class="col-md-10 col-lg-10">
                                    <div class="input-group-addon">
                                        <label for="passInput">Password</label>
                                        <div class="input-group-text">
                                            <input type="password" name="password" id="passInput" class="form-control"
                                                placeholder="Masukkan kata sandi ...." required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2"></div>
                            <div class="modal-footer"></div>
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary" name="submited">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Log In</span>
                                </button>
                                <button type="reset" class="btn btn-danger">
                                    <i class="fas fa-eraser"></i>
                                    <span>Reset</span>
                                </button>
                            </p>
                        </form>
                        <p class="text-center">
                            <a href="" data-bs-target="#modalSignUp" data-bs-toggle="modal"
                                class="text-decoration-none text-primary">
                                buat akun
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalSignUp" tabindex="-1">
                <div class="modal-dialog">
                    <div class="container-fluid pt-5 opacity-75">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Register Account Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="index.php?act=register" method="post">
                                    <div class="row form-group input-group
                                    d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="col-md-10 col-lg-10">
                                            <div class="input-group-addon">
                                                <label for="emailInput">Email</label>
                                                <div class="input-group-text">
                                                    <input type="email" name="email" id="emailInput"
                                                        class="form-control" placeholder="Masukkan Email baru anda ..."
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <div class="row form-group input-group
                                    d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="col-md-10 col-lg-10">
                                            <div class="input-group-addon">
                                                <label for="userInputs">Username</label>
                                                <div class="input-group-text">
                                                    <input type="text" name="username" id="userInputs"
                                                        class="form-control"
                                                        placeholder="Masukkan Username baru anda ..." required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <div class="row form-group input-group 
                                        d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="col-md-10 col-lg-10">
                                            <div class="input-group-addon">
                                                <label for="passwdInput">Password</label>
                                                <div class="input-group-text">
                                                    <input type="password" name="password" id="passwdInput"
                                                        class="form-control" placeholder="Masukkan kata sandi ...."
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <div class="row form-group input-group
                                        d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="col-md-10 col-lg-10">
                                            <div class="input-group-addon">
                                                <label for="namaInput">Nama Anda</label>
                                                <div class="input-group-text">
                                                    <input type="text" name="nama" id="namaInput" class="form-control"
                                                        placeholder="Masukkan nama anda ..." required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <div class="row form-group input-group
                                        d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="col-md-10 col-lg-10">
                                            <div class="input-group-addon">
                                                <label for="jabatanInput">Jabatan Anda</label>
                                                <div class="input-group-text">
                                                    <input type="text" name="user_level" readonly value="admin"
                                                        id="jabatanInput" class="form-control"
                                                        placeholder="Masukkan jabatan anda ..." required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer"></div>
                                    <p class="text-center">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                            <i class="fas fa-save"></i>
                                            <span>Simpan</span>
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fas fa-eraser"></i>
                                            <span>Reset</span>
                                        </button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid col-md-12 col-lg-12 fixed-bottom border border-dark">
                <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-2 py-2 my-2">
                    <p class="text-start text-light">
                        &copy; Dashboard Toko Penyimpanan Barang
                    </p>
                </footer>
                <div class="border-top border-dark"></div>
                <p class="text-end text-light" id="time"></p>
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
    function startTime() {
        var today = new Date();
        var tahun = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('time').innerHTML =
            h + ":" + m + ":" + s + ", " + tahun;
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
    </script>
</body>

</html>