<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
        $this->load->model('api_model', 'api');
    }
    public function category()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $response = [];

        if ($method == "GET") {
            $id = $this->input->get('id');
            if ($id == null) {
                $fetchAll = $this->api->getAllCategory();

                foreach ($fetchAll as $fetch) {
                    $get = [
                        'id' => $fetch['id_kategori'],
                        'kategori' => $fetch['nama_kategori']
                    ];

                    array_push($response, $get);
                }
            } else {
                $fetchIdCat = $this->api->getIdCat($id);

                $fetch = $fetchIdCat->row_array();
                if ($fetchIdCat->num_rows() > 0) {
                    $get = [
                        'id' => $fetch['id_kategori'],
                        'kategori' => $fetch['nama_kategori']
                    ];
                } else {
                    $get = [
                        'id' => null,
                        'kategori' => "Kategori Tidak Ditemukan"
                    ];
                }

                array_push($response, $get);
            }
        }

        if ($method == "POST") {
            $kategori = $this->input->post('cat');

            $this->api->insertCategory($kategori);

            $post = [
                'status' => "Sukses",
                'message' => "Kategori Berhasil Ditambahkan"
            ];

            array_push($response, $post);
        }

        if ($method == "PUT") {
            parse_str(file_get_contents("php://input"), $data);

            if ($this->api->getIdCat($data['id'])->num_rows() > 0) {
                $this->api->updateCategory($data['id'], $data['cat']);
                $put = [
                    'status' => "Sukses",
                    'message' => "Kategori Berhasil Diubah"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Kategori Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        if ($method == "DELETE") {
            $id = $this->uri->segment(3);

            if ($this->api->getIdCat($id)->num_rows() > 0) {
                $this->api->deleteCategory($id);
                $put = [
                    'status' => "Sukses",
                    'message' => "Kategori Berhasil Dihapus"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Kategori Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        echo header("Content-Type: application/json");
        echo json_encode($response);
    }

    public function admin()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $response = [];

        if ($method == "GET") {
            $id = $this->input->get('id');
            if ($id == null) {
                $fetchAll = $this->api->getAllAdmin();

                foreach ($fetchAll as $fetch) {
                    $get = [
                        'id' => $fetch['id_admin'],
                        'admin' => $fetch['nama_admin'],
                        'username' => $fetch['username'],
                        'password' => $fetch['password']
                    ];

                    array_push($response, $get);
                }
            } else {
                $fetchIdCat = $this->api->getIdAdm($id);

                $fetch = $fetchIdCat->row_array();

                if ($fetchIdCat->num_rows() > 0) {
                    $get = [
                        'id' => $fetch['id_admin'],
                        'admin' => $fetch['nama_admin'],
                        'username' => $fetch['username'],
                        'password' => $fetch['password']
                    ];
                } else {
                    $get = [
                        'id' => null,
                        'admin' => "Admin Tidak Ditemukan"
                    ];
                }
                array_push($response, $get);
            }
        }

        if ($method == "POST") {
            $admin = $this->input->post('admin');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $post = [
                'nama_admin' => $admin,
                'username' => $username,
                'password' => md5($password)
            ];

            $this->api->insertAdmin($post);

            $post = [
                'status' => "Sukses",
                'message' => "Admin Berhasil Ditambahkan"
            ];

            array_push($response, $post);
        }

        if ($method == "PUT") {
            parse_str(file_get_contents("php://input"), $data);

            $getPassword = $this->db->get_where('admin', array('id_admin' => $data['id']))->row_array();

            if (!$data['password']) {
                $password = $getPassword['password'];
            } else {
                $password = md5($data['password']);
            }

            $put = [
                'nama_admin' => $data['admin'],
                'username' => $data['username'],
                'password' => $password
            ];

            if ($this->api->getIdAdm($data['id'])->num_rows() > 0) {
                $this->api->updateAdmin($data['id'], $put);
                $put = [
                    'status' => "Sukses",
                    'message' => "Admin Berhasil Diubah"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Admin Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        if ($method == "DELETE") {
            $id = $this->uri->segment(3);

            if ($this->api->getIdAdm($id)->num_rows() > 0) {
                $this->api->deleteAdmin($id);
                $put = [
                    'status' => "Sukses",
                    'message' => "Admin Berhasil Dihapus"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Admin Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        echo header("Content-Type: application/json");
        echo json_encode($response);
    }

    public function anggota()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $response = [];

        if ($method == "GET") {
            $id = $this->input->get('id');
            if ($id == null) {
                $fetchAll = $this->api->getAllAnggota();

                foreach ($fetchAll as $fetch) {
                    $get = [
                        'id' => $fetch['id_anggota'],
                        'nama' => $fetch['nama_anggota'],
                        'username' => $fetch['username'],
                        'gender' => $fetch['gender'],
                        'no_telp' => $fetch['no_telp'],
                        'alamat' => $fetch['alamat'],
                        'email' => $fetch['email']
                    ];

                    array_push($response, $get);
                }
            } else {
                $fetchIdCat = $this->api->getIdAnggota($id);

                $fetch = $fetchIdCat->row_array();

                if ($fetchIdCat->num_rows() > 0) {
                    $get = [
                        'id' => $fetch['id_anggota'],
                        'nama' => $fetch['nama_anggota'],
                        'username' => $fetch['username'],
                        'gender' => $fetch['gender'],
                        'no_telp' => $fetch['no_telp'],
                        'alamat' => $fetch['alamat'],
                        'email' => $fetch['email']
                    ];
                } else {
                    $get = [
                        'id' => null,
                        'anggota' => "Admin Tidak Ditemukan"
                    ];
                }
                array_push($response, $get);
            }
        }

        if ($method == "POST") {
            $username = $this->input->post('username');
            $nama = $this->input->post('nama');
            $gender = $this->input->post('gender');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $data = [
                'username' => $username,
                'nama_anggota' => $nama,
                'gender' => $gender,
                'no_telp' => $no_telp,
                'alamat' => $alamat,
                'email' => $email,
                'password' => md5($password),
            ];

            $this->api->insertAnggota($data);

            $post = [
                'status' => "Sukses",
                'message' => "Anggota Berhasil Ditambahkan"
            ];

            array_push($response, $post);
        }

        if ($method == "PUT") {
            parse_str(file_get_contents("php://input"), $data);

            if ($this->api->getIdAnggota($data['id'])->num_rows() > 0) {
                $username = $data['username'];
                $nama = $data['nama'];
                $gender = $data['gender'];
                $no_telp = $data['no_telp'];
                $alamat = $data['alamat'];
                $email = $data['email'];

                $anggota = [
                    'username' => $username,
                    'nama_anggota' => $nama,
                    'gender' => $gender,
                    'no_telp' => $no_telp,
                    'alamat' => $alamat,
                    'email' => $email
                ];

                $this->api->updateAnggota($data['id'], $anggota);
                $put = [
                    'status' => "Sukses",
                    'message' => "Anggota Berhasil Diubah"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Anggota Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        if ($method == "DELETE") {
            $id = $this->uri->segment(3);

            if ($this->api->getIdAnggota($id)->num_rows() > 0) {
                $this->api->deleteAnggota($id);
                $put = [
                    'status' => "Sukses",
                    'message' => "Anggota Berhasil Dihapus"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Anggota Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        echo header("Content-Type: application/json");
        echo json_encode($response);
    }

    public function buku()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $response = [];

        if ($method == "GET") {
            $id = $this->input->get('id');
            if ($id == null) {
                $fetchAll = $this->api->getAllBuku();

                foreach ($fetchAll as $fetch) {
                    $get = [
                        'id' => $fetch['id_buku'],
                        'id_kategori' => $fetch['id_kategori'],
                        'judul_buku' => $fetch['judul_buku'],
                        'pengarang' => $fetch['pengarang'],
                        'thn_terbit' => $fetch['thn_terbit'],
                        'penerbit' => $fetch['penerbit'],
                        'isbn' => $fetch['isbn'],
                        'jumlah_buku' => $fetch['jumlah_buku'],
                        'lokasi' => $fetch['lokasi'],
                        'gambar' => $fetch['gambar'],
                        'tgl_input' => $fetch['tgl_input'],
                        'status_buku' => $fetch['status_buku']
                    ];

                    array_push($response, $get);
                }
            } else {
                $fetchIdCat = $this->api->getIdBuku($id);

                $fetch = $fetchIdCat->row_array();

                if ($fetchIdCat->num_rows() > 0) {
                    $get = [
                        'id' => $fetch['id_buku'],
                        'id_kategori' => $fetch['id_kategori'],
                        'judul_buku' => $fetch['judul_buku'],
                        'pengarang' => $fetch['pengarang'],
                        'thn_terbit' => $fetch['thn_terbit'],
                        'penerbit' => $fetch['penerbit'],
                        'isbn' => $fetch['isbn'],
                        'jumlah_buku' => $fetch['jumlah_buku'],
                        'lokasi' => $fetch['lokasi'],
                        'gambar' => $fetch['gambar'],
                        'tgl_input' => $fetch['tgl_input'],
                        'status_buku' => $fetch['status_buku']
                    ];
                } else {
                    $get = [
                        'id' => null,
                        'anggota' => "Buku Tidak Ditemukan"
                    ];
                }
                array_push($response, $get);
            }
        }

        if ($method == "POST") {
            $data = [
                'id_kategori' => $this->input->post('id_kategori'),
                'judul_buku' => $this->input->post('judul_buku'),
                'pengarang' => $this->input->post('pengarang'),
                'thn_terbit' => $this->input->post('thn_terbit'),
                'penerbit' => $this->input->post('penerbit'),
                'isbn' => $this->input->post('isbn'),
                'jumlah_buku' => $this->input->post('jumlah_buku'),
                'lokasi' => $this->input->post('lokasi'),
                'gambar' => $this->input->post('gambar'),
                'tgl_input' => $this->input->post('tgl_input'),
                'status_buku' => $this->input->post('status_buku')
            ];

            $this->api->insertBuku($data);

            $post = [
                'status' => "Sukses",
                'message' => "Buku Berhasil Ditambahkan"
            ];

            array_push($response, $post);
        }

        if ($method == "PUT") {
            parse_str(file_get_contents("php://input"), $data);

            if ($this->api->getIdBuku($data['id'])->num_rows() > 0) {
                $buku = [
                    'id_kategori' => $data['id_kategori'],
                    'judul_buku' => $data['judul_buku'],
                    'pengarang' => $data['pengarang'],
                    'thn_terbit' => $data['thn_terbit'],
                    'penerbit' => $data['penerbit'],
                    'isbn' => $data['isbn'],
                    'jumlah_buku' => $data['jumlah_buku'],
                    'lokasi' => $data['lokasi'],
                    'gambar' => $data['gambar'],
                    'tgl_input' => $data['tgl_input'],
                    'status_buku' => $data['status_buku']
                ];
                $this->api->updateBuku($data['id'], $buku);
                $put = [
                    'status' => "Sukses",
                    'message' => "Buku Berhasil Diubah"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Buku Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        if ($method == "DELETE") {
            $id = $this->uri->segment(3);

            if ($this->api->getIdBuku($id)->num_rows() > 0) {
                $this->api->deleteBuku($id);
                $put = [
                    'status' => "Sukses",
                    'message' => "Buku Berhasil Dihapus"
                ];
            } else {
                $put = [
                    'status' => "Gagal",
                    'message' => "Buku Tidak Ditemukan"
                ];
            }
            array_push($response, $put);
        }

        echo header("Content-Type: application/json");
        echo json_encode($response);
    }
}
