<?php

namespace App\Controllers;
Use App\Models\M_siapake;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends BaseController
{


	public function dashboard()
{
    $model = new M_siapake();
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Ambil nama pengguna dari session
    $session = session();
    $data['username'] = $session->get('username');

    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Dashboard',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('dashboard', $data);
    echo view('footer');
}
	public function login()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Login',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('login');
	}




public function aksi_login()
{
    // Periksa koneksi internet
    if (!$this->checkInternetConnection()) {
        // Jika tidak ada koneksi, cek CAPTCHA gambar
        $captcha_code = $this->request->getPost('captcha_code');
        if (session()->get('captcha_code') !== $captcha_code) {
            session()->setFlashdata('toast_message', 'Invalid CAPTCHA');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika ada koneksi, cek Google reCAPTCHA
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $secret = '6LefTYMqAAAAAC1hYWZVpC0-nPwlZkdDZaDXlKi1'; // Ganti dengan Secret Key Anda
        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            session()->setFlashdata('toast_message', 'Captcha validation failed');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    }


    
    // Proses login seperti biasa
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');

    $where = array(
        'username' => $u,
        'password' => md5($p),
    );
    $model = new M_siapake;
    $cek = $model->getWhere('user', $where);

    if ($cek) {
        session()->set('nama', $cek->username);
        session()->set('id', $cek->id_user);
        session()->set('level', $cek->level);
        return redirect()->to('home/dashboard');
    } else {
        session()->setFlashdata('toast_message', 'Invalid login credentials');
        session()->setFlashdata('toast_type', 'danger');
        return redirect()->to('home/login');
    }
}



public function generateCaptcha()
{
    // Create a string of possible characters
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha_code = '';
    
    // Generate a random CAPTCHA code with letters and numbers
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store CAPTCHA code in session
    session()->set('captcha_code', $captcha_code);
    
    // Create an image for CAPTCHA
    $image = imagecreate(120, 40); // Increased size for better readability
    $background = imagecolorallocate($image, 200, 200, 200);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    
    imagefilledrectangle($image, 0, 0, 120, 40, $background);
    
    // Add some random lines to the CAPTCHA image for added complexity
    for ($i = 0; $i < 5; $i++) {
        imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
    }
    
    // Add the CAPTCHA code to the image
    imagestring($image, 5, 20, 10, $captcha_code, $text_color);
    
    // Output the CAPTCHA image
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}




public function checkInternetConnection()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    } else {
        return false;
    }
}



public function register()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Register',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('register');
	}


	public function aksi_t_register()
{
    if(session()->get('id') > 0) {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Hash the password using MD5
        $hashedPassword = md5($password);

        $darren = array(
            'username' => $username,
            'password' => $hashedPassword, 
			'level' => 'pengguna',  // Store the hashed password
        );

        // Initialize the model
        $model = new M_siapake;
        $model->tambah('user', $darren);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/login');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}


public function log_activity(){

	$model = new M_siapake;
	$data['users'] = $model->getAllUsers();

	$userId = $this->request->getGet('user_id');

	// Fetch logs with optional filtering
	if (!empty($userId)) {
		$data['logs'] = $model->getLogsByUser($userId);
	} else {
		$data['logs'] = $model->getLogs();
	}
	$where = array('id_setting' => '1');
	$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
	$id_user = session()->get('id');
	$activityLog = [
		'id_user' => $id_user,
		'menu' => 'Masuk ke Log Activity',
		'time' => date('Y-m-d H:i:s')
	];
	$model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
	echo view('log_activity', $data);
	echo view('footer');
}


public function jurusan()
	{
		$model= new M_siapake();
        $data['oke'] = $model->tampil('jurusan');
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Jurusan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('jurusan');
    echo view('footer');
	}


    public function hapus_jurusan($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_jurusan' => $id);
        $model->hapus('jurusan', $where);
    
        return redirect()->to('home/jurusan');
    }

    public function t_jurusan()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Jurusan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('t_jurusan', $data);
	}

    public function aksi_t_jurusan()
{
if(session()->get('id') > 0){
    $nama_jurusan = $this->request->getPost('nama_jurusan');

    // Menggunakan MD5 untuk hash password "sph"

    $yoga = array(
        'nama_jurusan' => $nama_jurusan,
    );

    $model = new M_siapake;
    $model->tambah('jurusan', $yoga); // Menyimpan data jurusan ke database
    return redirect()->to('home/jurusan');
} else {
    return redirect()->to('home/login');
}
}


public function e_jurusan($id_jurusan) {  // Terima parameter id_jurusan
    $model = new M_siapake;
    
    // Mengambil data setting
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    
    // Ambil data jurusan berdasarkan id_jurusan yang diterima
    $wherejurusan = array('id_jurusan' => $id_jurusan);
    $data['oke'] = $model->getWhere1('jurusan', $wherejurusan)->getRow();  // Mengambil data user spesifik berdasarkan ID

    // Log aktivitas
    $id_user_session = session()->get('id');
    $activityLog = [
        'id_user' => $id_user_session,
        'menu' => 'Masuk ke Edit Jurusan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Memuat view
    echo view('header', $data);
    echo view('menu');
    echo view('e_jurusan', $data);
}


public function aksi_e_jurusan()
{
if(session()->get('id') > 0){
    $nama_jurusan = $this->request->getPost('nama_jurusan');
    $id = $this->request->getPost('id_jurusan');
        
    $where = array('id_jurusan' => $id);

    $isi = array(
        'nama_jurusan' => $nama_jurusan,
    );

    $model = new M_siapake;
    $model->edit('jurusan', $isi, $where);
    // print_r($isi); // Menyimpan data jurusan ke database
    return redirect()->to('home/jurusan');
} else {
    return redirect()->to('home/login');
}
}


public function kelas()
	{
		$model= new M_siapake();
        $data['oke'] = $model->tampilkelas();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Kelas',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('kelas');
    echo view('footer');
	}

    public function hapus_kelas($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_kelas' => $id);
        $model->hapus('kelas', $where);
    
        return redirect()->to('home/kelas');
    }

    public function t_kelas()
	{
		$model= new M_siapake();
        $data['yoga'] = $model->tampil('jurusan');
        $data['yoga1'] = $model->tampil('user');
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah Kelas',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('t_kelas');
	}


    public function aksi_t_kelas()
{
if(session()->get('id') > 0){
    $nama_kelas = $this->request->getPost('nama_kelas');
    $nama_jurusan = $this->request->getPost('nama_jurusan');
    $username = $this->request->getPost('username');

    // Menggunakan MD5 untuk hash password "sph"

    $yoga = array(
        'nama_kelas' => $nama_kelas,
        'id_jurusan' => $nama_jurusan,
        'id_user' => $username,
    );

    $model = new M_siapake;
    $model->tambah('kelas', $yoga); // Menyimpan data kelas ke database
    return redirect()->to('home/kelas');
} else {
    return redirect()->to('home/login');
}
}



public function e_kelas($id_kelas) {  // Terima parameter id_kelas
    $model = new M_siapake;
    
    // Mengambil data setting
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    
    // Ambil data kelas berdasarkan id_kelas yang diterima
    $wherekelas = array('id_kelas' => $id_kelas);
    $data['oke'] = $model->getWhere1('kelas', $wherekelas)->getRow();  // Mengambil data user spesifik berdasarkan ID
    $data['yoga'] = $model->tampil('jurusan');
    $data['yoga1'] = $model->tampil('user');
    // Log aktivitas
    $id_user_session = session()->get('id');
    $activityLog = [
        'id_user' => $id_user_session,
        'menu' => 'Masuk ke Edit kelas',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Memuat view
    echo view('header', $data);
    echo view('menu');
    echo view('e_kelas', $data);
}


public function aksi_e_kelas()
{
if(session()->get('id') > 0){
    $nama_kelas = $this->request->getPost('nama_kelas');
    $nama_jurusan = $this->request->getPost('nama_jurusan');
    $username = $this->request->getPost('username');
    $id = $this->request->getPost('id_kelas');
        
    $where = array('id_kelas' => $id);

    $isi = array(
        'nama_kelas' => $nama_kelas,
        'id_jurusan' => $nama_jurusan,
        'id_user' => $username,
    );

    $model = new M_siapake;
    $model->edit('kelas', $isi, $where);
    // print_r($isi); // Menyimpan data kelas ke database
    return redirect()->to('home/kelas');
} else {
    return redirect()->to('home/login');
}
}


public function pengumuman()
	{
		$model= new M_siapake();
  
$data['oke1'] = $model->tampil('pengumuman');
        $data['yoga'] = $model->tampil('jurusan');
        $data['yoga1'] = $model->tampil('kelas');
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Pengumuman Umum',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('pengumuman');
    echo view('footer');
	}

    public function e_pengumuman($id_pengumuman)
	{
		$model= new M_siapake();

        $wherepengumuman = array('id_pengumuman' => $id_pengumuman);
        $data['oke'] = $model->getWhere1('pengumuman', $wherepengumuman)->getRow();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Edit Pengumuman Umum',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('e_pengumuman');
    echo view('footer');
	}

    public function aksi_e_pengumuman()
{
    if (session()->get('id') > 0) {
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $id = $this->request->getPost('id_pengumuman');
        $file = $this->request->getFile('file');

        // Tentukan lokasi penyimpanan file
        $uploadPath = FCPATH . 'uploads/';
        $newFileName = null;

        // Proses file jika ada yang diunggah
        if ($file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName(); // Buat nama file yang unik
            $file->move($uploadPath, $newFileName); // Simpan file ke folder 'uploads'
        }

        // Siapkan data yang akan diperbarui
        $updateData = [
            'judul' => $judul,
            'isi' => $isi,
        ];

        // Jika file baru diunggah, tambahkan ke data yang diperbarui
        if ($newFileName) {
            $updateData['file'] = $newFileName;

            // Hapus file lama jika ada
            $model = new M_siapake();
            // Mengambil pengumuman yang ada dengan getWhere1
            $wherepengumuman = array('id_pengumuman' => $id);
            $existingPengumuman = $model->getWhere1('pengumuman', $wherepengumuman)->getRow();

            if ($existingPengumuman && $existingPengumuman->file) {
                $oldFile = $uploadPath . $existingPengumuman->file;
                if (file_exists($oldFile)) {
                    unlink($oldFile); // Hapus file lama
                }
            }
        }

        // Update data ke database
        $model = new M_siapake();
        $model->edit('pengumuman', $updateData, ['id_pengumuman' => $id]);

        // Redirect kembali ke halaman pengumuman
        return redirect()->to('home/pengumuman');
    } else {
        return redirect()->to('home/login');
    }
}


    


    public function t_pengumuman()
	{
		$model= new M_siapake();
        $data['yoga'] = $model->tampil('jurusan');
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah Pengumuman Umum',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('t_pengumuman');
	}

    public function aksi_t_pengumuman()
    {
        if (session()->get('id') > 0) {
            // Ambil data dari form
            $judul = $this->request->getPost('judul');
            $isi = $this->request->getPost('isi');
            $file = $this->request->getFile('file');
            $share_email = $this->request->getPost('share_email');
            $share_whatsapp = $this->request->getPost('share_whatsapp'); // Checkbox Share via WhatsApp
            $id_jurusan = $this->request->getPost('nama_jurusan');

            // Proses upload file jika ada
            $newFileName = null;
            if ($file->isValid() && !$file->hasMoved()) {
                $newFileName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $newFileName);
            }

            // Data yang disimpan ke database
            $yoga = [
                'judul' => $judul,
                'isi' => $isi,
                'file' => $newFileName,
                'tanggal' => date('Y-m-d H:i:s'),
            ];

            // Simpan ke database
            $model = new M_siapake();
            $model->tambah('pengumuman', $yoga);

            // Objek pengumuman untuk dikirim
            $pengumuman = (object)[
                'judul' => $judul,
                'isi' => $isi,
                'file' => $newFileName,
            ];

            // Kirim email jika diperlukan
            if ($share_email) {
                $this->kirimPengumuman($pengumuman, $id_jurusan);
            }

            // Kirim WhatsApp jika diperlukan
            if ($share_whatsapp) {
                $this->kirimPengumumanWhatsApp($pengumuman, $id_jurusan);
            }

            return redirect()->to('home/pengumuman')->with('success', 'Pengumuman berhasil ditambahkan!');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function hapus_pengumuman_umum($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_pengumuman' => $id);
        $model->hapus('pengumuman', $where);
    
        return redirect()->to('home/pengumuman');
    }

private function kirimPengumuman($pengumuman, $id_jurusan)
{
    $model = new M_siapake();

    // Pilih model yang sesuai
    $emails = empty($id_jurusan) 
        ? $model->findAllEmails1() // Semua email
        : $model->findEmailsByJurusan($id_jurusan); // Berdasarkan jurusan

    if (!empty($emails)) {
        // Tentukan subjek dan pesan untuk email
        $subject = 'Pengumuman: ' . $pengumuman->judul;
        $message = $pengumuman->isi;

        // Tentukan path lampiran jika ada
        $attachmentPath = $pengumuman->file ? 'uploads/' . $pengumuman->file : null;

        // Kirim email ke setiap email yang ditemukan
        foreach ($emails as $email) {
            $emailAddress = empty($id_jurusan) ? $email : $email['email_siswa'];
            if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                $this->sendEmail($emailAddress, $subject, $message, $attachmentPath);
            }
        }
    } else {
        log_message('info', 'Tidak ada email yang ditemukan.');
    }
}






private function sendEmail($to, $subject, $body, $pdfFilePath = null)
{
    $mail = new PHPMailer(true);
    try {
        // Pengaturan server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kaizenesia@gmail.com';
        $mail->Password = 'aobm loez jqqv xftw'; // Gunakan password aplikasi
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Penerima email
        $mail->setFrom('kaizenesia@gmail.com', 'Sekolah Permata Harapan');
        $mail->addAddress($to); // Penerima email dari query

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = nl2br($body);

        // Lampiran file jika ada
        if ($pdfFilePath && file_exists($pdfFilePath)) {
            $mail->addAttachment($pdfFilePath);
        }

        // Kirim email
        $mail->send();
        return true;
    } catch (Exception $e) {
        log_message('error', 'Email gagal dikirim: ' . $mail->ErrorInfo);
        return false;
    }
}


private function kirimPengumumanWhatsApp($pengumuman, $id_jurusan)
    {
        $model = new M_siapake();

        $numbers = empty($id_jurusan)
            ? $model->findAllNumbers()
            : $model->findNumbersByJurusan($id_jurusan);

        if (!empty($numbers)) {
            $message = "*Pengumuman: " . $pengumuman->judul . "*\n\n" . $pengumuman->isi;

            foreach ($numbers as $number) {
                $phoneNumber = empty($id_jurusan) ? $number : $number['whatsapp_number'];
                if ($this->isValidPhoneNumber($phoneNumber)) {
                    $this->sendWhatsAppMessage($phoneNumber, $message);
                }
            }
        } else {
            log_message('info', 'Tidak ada nomor WhatsApp yang ditemukan.');
        }
    }

    private function isValidPhoneNumber($phoneNumber)
    {
        return preg_match('/^[0-9]{10,15}$/', $phoneNumber);
    }

    private function sendWhatsAppMessage($phone, $message, $file = null)
{
    // Ganti dengan URL API UltraMsg Anda
    $instance_id = 'instance103830'; // Instance ID Anda
    $token = '7j4g0bmq1yg979c4'; // API Key Anda

    // URL API UltraMsg
    $url = "https://api.ultramsg.com/$instance_id/messages/chat";

    // Data untuk mengirim pesan
    $data = [
        'token' => $token,
        'to' => $phone,
        'body' => $message
    ];

    // Jika ada file, kirimkan file sebagai attachment
    if ($file) {
        // Pastikan file URL yang valid sudah tersedia
        $data['mediaUrl'] = $file;  // Attach file URL under mediaUrl
    }

    // Mengirim HTTP POST request menggunakan file_get_contents
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Mengecek apakah ada error dalam respon API
    if ($response === FALSE) {
        log_message('error', "Gagal mengirim pesan ke $phone");
        return false;
    }

    // Tampilkan response dari API
    log_message('info', "Pesan WhatsApp berhasil dikirim ke $phone");
    return $response;
}




public function pengumuman_terpilih()
{
    $model = new M_siapake();

    // Ambil level user dari session
    $userLevel = session()->get('level'); // Pastikan level user ada di session

    // Jika level user admin, kepsek, atau wakepsek, ambil semua pengumuman
    if (in_array($userLevel, ['admin', 'kepsek', 'wakepsek'])) {
        $data['oke1'] = $model->tampil('pengumuman'); // Ambil semua pengumuman tanpa filter
    } else {
        // Jika bukan admin, kepsek, atau wakepsek, gunakan filter 'created_by'
        $where = array('created_by' => session()->get('id'));
        $data['oke1'] = $model->tampilwhere('pengumuman', $where);
    }

    // Ambil setting pengumuman
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Log activity
    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Pengumuman Terpilih',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);

    // Tampilkan view
    echo view('header', $data);
    echo view('menu');
    echo view('pengumuman_terpilih');
    echo view('footer');
}

public function e_pengumuman_terpilih($id_pengumuman)
	{
		$model= new M_siapake();

        $wherepengumuman = array('id_pengumuman' => $id_pengumuman);
        $data['oke'] = $model->getWhere1('pengumuman', $wherepengumuman)->getRow();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Edit Pengumuman Terpilih',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('e_pengumuman_terpilih');
    echo view('footer');
	}

    public function aksi_e_pengumuman_terpilih()
{
    if (session()->get('id') > 0) {
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $id = $this->request->getPost('id_pengumuman');
        $file = $this->request->getFile('file');

        // Tentukan lokasi penyimpanan file
        $uploadPath = FCPATH . 'uploads/';
        $newFileName = null;

        // Proses file jika ada yang diunggah
        if ($file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName(); // Buat nama file yang unik
            $file->move($uploadPath, $newFileName); // Simpan file ke folder 'uploads'
        }

        // Siapkan data yang akan diperbarui
        $updateData = [
            'judul' => $judul,
            'isi' => $isi,
        ];

        // Jika file baru diunggah, tambahkan ke data yang diperbarui
        if ($newFileName) {
            $updateData['file'] = $newFileName;

            // Hapus file lama jika ada
            $model = new M_siapake();
            // Mengambil pengumuman yang ada dengan getWhere1
            $wherepengumuman = array('id_pengumuman' => $id);
            $existingPengumuman = $model->getWhere1('pengumuman', $wherepengumuman)->getRow();

            if ($existingPengumuman && $existingPengumuman->file) {
                $oldFile = $uploadPath . $existingPengumuman->file;
                if (file_exists($oldFile)) {
                    unlink($oldFile); // Hapus file lama
                }
            }
        }

        // Update data ke database
        $model = new M_siapake();
        $model->edit('pengumuman', $updateData, ['id_pengumuman' => $id]);

        // Redirect kembali ke halaman pengumuman
        return redirect()->to('home/pengumuman');
    } else {
        return redirect()->to('home/login');
    }
}


    public function t_pengumuman_terpilih()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah Pengumuman',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('t_pengumuman_terpilih');
	}

    public function aksi_t_pengumuman_terpilih()
{
    if (session()->get('id') > 0) {
        // Ambil data dari form
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $file = $this->request->getFile('file');
        $share_email = $this->request->getPost('share_email'); // Ambil status checkbox Share via Email
        $id_user = session()->get('id');
        // Proses upload file jika ada
        $newFileName = null;
        if ($file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName(); // Menyimpan file dengan nama acak
            $file->move(FCPATH . 'uploads', $newFileName); // Memindahkan file ke folder 'uploads'
        }

        // Menyiapkan data untuk disimpan ke database
        $yoga = array(
            'judul' => $judul,
            'isi' => $isi,
            'file' => $newFileName, // Menyimpan nama file
            'tanggal' => date('Y-m-d H:i:s'),
            'created_by' => $id_user,
                'created_at' => date('Y-m-d H:i:s')
        );

        // Menyimpan pengumuman ke database
        $model = new M_siapake();
        $model->tambah('pengumuman', $yoga);

        // Membuat objek pengumuman untuk email
        $pengumuman = (object)[
            'judul' => $judul,
            'isi' => $isi,
            'file' => $newFileName, // Lampiran jika ada
        ];

        // Cek apakah share_email dicentang, jika ya kirim pengumuman ke email
        if ($share_email) {
            // Kirim pengumuman melalui email
            $send_to_email = true;
            $this->kirimPengumuman_terpilih($pengumuman, $send_to_email);

            // Subjek dan pesan untuk email
            $subject = '' . $judul;
            $message = "Isi Pengumuman:\n$isi\nFile: " . ($newFileName ? 'Terlampir' : 'Tidak ada lampiran');

            // Kirim email (gunakan fungsi sendEmail yang sudah Anda buat)
            $attachmentPath = $newFileName ? 'uploads/' . $newFileName : null;
            $emailSent = $this->sendEmail('example@example.com', $subject, $message, $attachmentPath); // Ganti dengan penerima email yang sesuai

            // Cek apakah email berhasil dikirim
            if ($emailSent) {
                return redirect()->to('home/pengumuman')->with('success', 'Pengumuman berhasil dikirim dan email terkirim');
            } else {
                return redirect()->to('home/pengumuman')->with('error', 'Pengumuman berhasil ditambahkan, tetapi email gagal dikirim');
            }
        } else {
            // Jika email tidak dipilih, hanya tampilkan pengumuman tanpa mengirim email
            return redirect()->to('home/pengumuman')->with('success', 'Pengumuman berhasil ditambahkan!');
        }
    } else {
        return redirect()->to('home/login');
    }
}

public function hapus_pengumuman_terpilih($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_pengumuman' => $id);
        $model->hapus('pengumuman', $where);
    
        return redirect()->to('home/pengumuman');
    }

private function kirimPengumuman_terpilih($pengumuman, $send_to_email)
{
    if ($send_to_email) {
        // Ambil data dari objek pengumuman
        $judul = $pengumuman->judul;
        $isi = $pengumuman->isi;
        $file = $pengumuman->file;

        // Tentukan subjek dan pesan untuk email
        $subject = '' . $judul;
        $message = $isi;

        // Tentukan path lampiran jika ada
        $attachmentPath = $file ? 'uploads/' . $file : null;

        // Ambil daftar email dari tabel siswa
        $model = new M_siapake();
        $emails = $model->findAllEmailsSiswa(); // Ambil semua email dari siswa (email_siswa dan email_ortu)

        // Kirim email ke setiap email yang ditemukan
        foreach ($emails as $email) {
            // Gabungkan email siswa dan email orang tua (jika ada)
            if (!empty($email->email_siswa)) {
                // Kirim email ke email siswa
                $this->sendEmail_terpilih($email->email_siswa, $subject, $message, $attachmentPath);
            }
            if (!empty($email->email_ortu)) {
                // Kirim email ke email orang tua
                $this->sendEmail_terpilih($email->email_ortu, $subject, $message, $attachmentPath);
            }
        }
    }
}









private function sendEmail_terpilih($to, $subject, $body, $pdfFilePath = null)
{
    $mail = new PHPMailer(true);
    try {
        // Pengaturan server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kaizenesia@gmail.com';
        $mail->Password = 'aobm loez jqqv xftw'; // Gunakan password aplikasi
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Penerima email
        $mail->setFrom('kaizenesia@gmail.com', 'Sekolah Permata Harapan');
        $mail->addAddress($to); // Penerima email dari query

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = nl2br($body);

        // Lampiran file jika ada
        if ($pdfFilePath && file_exists($pdfFilePath)) {
            $mail->addAttachment($pdfFilePath);
        }

        // Kirim email
        $mail->send();
        return true;
    } catch (Exception $e) {
        log_message('error', 'Email gagal dikirim: ' . $mail->ErrorInfo);
        return false;
    }
}


public function siswa()
	{
		$model= new M_siapake();
  
        $data['oke'] = $model->tampilsiswa();
        $data['yoga'] = $model->tampil('kelas');
        
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Siswa',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('siswa');
    echo view('footer');
	}

    public function t_siswa()
	{
		$model= new M_siapake();
  
        $data['yoga'] = $model->tampil('kelas');
        
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah Siswa',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('t_siswa');
	}

    public function aksi_t_siswa()
{
if(session()->get('id') > 0){
    $nama_kelas = $this->request->getPost('nama_kelas');
    $nama_siswa = $this->request->getPost('nama_siswa');
    $email_siswa = $this->request->getPost('email_siswa');
    $no_siswa = $this->request->getPost('no_siswa');
    $email_ortu = $this->request->getPost('email_ortu');
    $no_ortu = $this->request->getPost('no_ortu');

    // Menggunakan MD5 untuk hash password "sph"

    $yoga = array(
        'id_kelas' => $nama_kelas,
        'nama_siswa' => $nama_siswa,
        'email_siswa' => $email_siswa,
        'no_siswa' => $no_siswa,
        'email_ortu' => $email_ortu,
        'no_ortu' => $no_ortu,
    );

    $model = new M_siapake;
    $model->tambah('siswa', $yoga); // Menyimpan data kelas ke database
    return redirect()->to('home/siswa');
} else {
    return redirect()->to('home/login');
}
}

public function e_siswa($id_siswa)
	{
		$model= new M_siapake();
  
        $data['yoga'] = $model->tampil('kelas');

        $wheresiswa = array('id_siswa' => $id_siswa);
    $data['oke'] = $model->getWhere1('siswa', $wheresiswa)->getRow(); 

    
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah Siswa',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('e_siswa');
	}

    public function aksi_e_siswa()
{
if(session()->get('id') > 0){
    $nama_kelas = $this->request->getPost('nama_kelas');
    $nama_siswa = $this->request->getPost('nama_siswa');
    $email_siswa = $this->request->getPost('email_siswa');
    $no_siswa = $this->request->getPost('no_siswa');
    $email_ortu = $this->request->getPost('email_ortu');
    $no_ortu = $this->request->getPost('no_ortu');

    $id = $this->request->getPost('id_siswa');
        
    $where = array('id_siswa' => $id);

    // Menggunakan MD5 untuk hash password "sph"

    $yoga = array(
        'id_kelas' => $nama_kelas,
        'nama_siswa' => $nama_siswa,
        'email_siswa' => $email_siswa,
        'no_siswa' => $no_siswa,
        'email_ortu' => $email_ortu,
        'no_ortu' => $no_ortu,
    );

    $model = new M_siapake;
    $model->edit('siswa', $yoga, $where); // Menyimpan data kelas ke database
    return redirect()->to('home/siswa');
} else {
    return redirect()->to('home/login');
}
}

public function soft_delete(){

    $model = new M_siapake;
    $data['oke'] = $model->tampilrestore('user');
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Soft Delete',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('soft_delete_user', $data);
    echo view('footer');
}

public function user()
	{
		$model= new M_siapake();
  
        $data['oke'] = $model->tampilactive('user');
        
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke User',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('user');
    echo view('footer');
	}


    public function hapus_user($id)
    {
        $model = new M_siapake();
        $where = array('id_user' => $id);
        $array = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );
        $model->edit('user', $array, $where);
        // $this->logUserActivity('Menghapus Pemesanan');

        return redirect()->to('home/user');
    }

    public function restore_user($id)
    {
        $model = new M_siapake();
        $where = array('id_user' => $id);
        $array = array(
            'deleted_at' => NULL, // Mengatur deleted_at menjadi null
        );
        $model->edit('user', $array, $where);
    
        return redirect()->to('home/user');
    }

    public function hapus_user_permanent($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_user' => $id);
        $model->hapus('user', $where);
    
        return redirect()->to('Home/user');
    }


    public function restore_edit_user(){

        $model = new M_siapake;
        $data['oke'] = $model->tampil('user_backup');
        $where = array('id_setting' => '1');
        $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Restore Edit User',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
        echo view('header', $data);
        echo view('menu');
        echo view('restore_edit_user', $data);
        echo view('footer');
    }

    public function aksi_restore_edit_user($id)
{
    $model = new M_siapake();
    
    $backupData = $model->getWhere('user_backup', ['id_user' => $id]);

    if ($backupData) {
       
        $restoreData = [
            'username' => $backupData->username,
            'email' => $backupData->email,
            'no_hp' => $backupData->no_hp,
            'level' => $backupData->level,
           
            // tambahkan field lainnya sesuai dengan struktur tabel menu
        ];
        unset($restoreData['id_user']);
        $model->edit('user', $restoreData, ['id_user' => $id]);
    }
    
    return redirect()->to('home/user');
}

    public function t_user()
	{
		$model= new M_siapake();
  
        
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Tambah User',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
    echo view('menu');
    echo view('t_user');
	}

    public function aksi_t_user()
{
if(session()->get('id') > 0){
    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');
    $no_hp = $this->request->getPost('no_hp');
    $level = $this->request->getPost('level');

    $password = md5('sph');

    // Menggunakan MD5 untuk hash password "sph"

    $yoga = array(
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'no_hp' => $no_hp,
        'level' => $level,
    );

    $model = new M_siapake;

    $model->tambah('user', $yoga); // Menyimpan data kelas ke database
    return redirect()->to('home/user');
} else {
    return redirect()->to('home/login');
}
}

public function e_user($id_user)
{
    $model = new M_siapake();

    $whereuser = array('id_user' => $id_user);
    $data['oke'] = $model->getWhere1('user', $whereuser)->getRow();

    // Tambahkan currentLevel dari data pengguna
    $data['currentLevel'] = $data['oke']->level ?? ''; // Pastikan defaultnya kosong jika tidak ada data

    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Edit User',
        'time' => date('Y-m-d H:i:s'),
    ];
    $model->logActivity($activityLog);

    echo view('header', $data);
    echo view('menu');
    echo view('e_user', $data); // Pastikan $data dikirim ke view
}


    public function aksi_e_user()
{
if(session()->get('id') > 0){
    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');
    $no_hp = $this->request->getPost('no_hp');
    $level = $this->request->getPost('level');
    $id = $this->request->getPost('id_user');


    $model = new M_siapake;
    $oldData = $model->getWhere('user', ['id_user' => $id]);

        // Simpan data lama ke tabel backup
        if ($oldData) {
            $backupData = [
                'id_user' => $oldData->id_user,  // integer
                'username' => $oldData->username,     
                'email' => $oldData->email,    
                'no_hp' => $oldData->no_hp,      // integer
                'level' => $oldData->level,     // integer
                'backup_by' => $oldData->backup_by,         // integer
                'backup_at' => $oldData->backup_at,         // datetime
            ];

            // Debug: cek hasil insert ke tabel backup
            if ($model->saveToBackup('user_backup', $backupData)) {
                echo "Data backup berhasil disimpan!";
            } else {
                echo "Gagal menyimpan data ke backup.";
            }
        } else {
            echo "Data lama tidak ditemukan.";
        }

        // Data baru yang akan diupdate
        $yoga = array(
           'username' => $username,
           'email' => $email,
           'no_hp' => $no_hp,
                'level' => $level,
                'updated_by' => session()->get('id'),
                'updated_at' => date('Y-m-d H:i:s'),
        );

        // Update data di tabel pemesanan
        $where = array('id_user' => $id);
        $model->edit('user', $yoga, $where);

        return redirect()->to('home/user');
    }
}


    
public function setting()
    {
      
                $model = new M_siapake;
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

                $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Setting',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
                echo view('header', $data);
                echo view('menu');
                echo view('setting', $data);
                echo view('footer');
           
    }

    public function aksi_e_setting()
    {
        $model = new M_siapake();
        // $this->logUserActivity('Melakukan Setting');
        $namaWebsite = $this->request->getPost('namawebsite');
        $id = $this->request->getPost('id');
        $id_user = session()->get('id');
        $where = array('id_setting' => '1');

        $data = array(
            'nama_website' => $namaWebsite,
            'update_by' => $id_user,
            'update_at' => date('Y-m-d H:i:s')
        );

        // Cek apakah ada file yang diupload untuk favicon
        $favicon = $this->request->getFile('img');
        if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {
            // Beri nama file unik
            $faviconNewName = $favicon->getRandomName();
            // Pindahkan file ke direktori public/images
            $favicon->move(WRITEPATH . '../public/images', $faviconNewName);

            // Tambahkan nama file ke dalam array data
            $data['tab_icon'] = $faviconNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            // Beri nama file unik
            $logoNewName = $logo->getRandomName();
            // Pindahkan file ke direktori public/images
            $logo->move(WRITEPATH . '../public/images', $logoNewName);

            // Tambahkan nama file ke dalam array data
            $data['logo_website'] = $logoNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $login = $this->request->getFile('login');
        if ($login && $login->isValid() && !$login->hasMoved()) {
            // Beri nama file unik
            $loginNewName = $login->getRandomName();
            // Pindahkan file ke direktori public/images
            $login->move(WRITEPATH . '../public/images', $loginNewName);

            // Tambahkan nama file ke dalam array data
            $data['login_icon'] = $loginNewName;
        }

        $model->edit('setting', $data, $where);

        // Optionally set a flash message here
        return redirect()->to('home/setting');
    }
}
