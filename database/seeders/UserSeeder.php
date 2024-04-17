<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'Jonathan Gandha',
            'email' => 'frevia212@gmail.com',
            'password' => bcrypt('jonathan123'),
            'date_of_birth' => '2004-05-12',
            'height' => 170,
            'weight' => 60,
            'phone' => '0812345678',
        ]);
        DB::table('users')->insert([
            'name' => 'Kenzo Gandha',
            'email' => 'kenzo@gmail.com',
            'password' => bcrypt('kenzo123'),
            'date_of_birth' => '2004-05-12',
            'height' => 170,
            'weight' => 60,
            'phone' => '0812345678',
        ]);

        // Bedah, THT, Gizi, Akupuntur, Jantung, Gigi
        DB::table('users')->insert([
            'name' => 'Dr. Natanael, Sp.B',
            'email' => 'nathanael@gmail.com',
            'password' => bcrypt('nathanael123'),
            'date_of_birth' => '1993-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Bedah',
            'about_doctor' => "Dr. Natanael, Sp.B, is a highly skilled specialist in the field of bedah (surgery), bringing a wealth of expertise and dedication to his practice. With years of rigorous training and clinical experience, Dr. Natanael is committed to providing the highest standard of care to his patients. Known for his precision and compassion, he approaches each case with meticulous attention to detail and a focus on achieving optimal outcomes. Patients can trust in Dr. Natanael's expertise and commitment to their well-being, making him a respected and valued member of the medical community.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Mario, Sp.THT',
            'email' => 'mario@gmail.com',
            'password' => bcrypt('mariol123'),
            'date_of_birth' => '2001-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'THT',
            'about_doctor' => "Dr. Mario, Sp.THT, is a distinguished specialist in THT (Telinga, Hidung, Tenggorokan), or Ear, Nose, and Throat medicine. With a profound dedication to the health and well-being of his patients, Dr. Mario brings extensive knowledge and experience to his practice. Renowned for his compassionate approach and comprehensive care, he strives to provide personalized treatment plans tailored to each individual's needs. Dr. Mario's expertise encompasses a wide range of conditions affecting the ear, nose, and throat, and his patients can rely on his expertise for accurate diagnosis and effective management. Whether it's addressing hearing loss, sinus issues, or throat disorders, Dr. Mario is committed to delivering the highest quality of care, ensuring his patients' comfort and satisfaction throughout their healthcare journey.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Feronika, Sp.GK',
            'email' => 'feronika@gmail.com',
            'password' => bcrypt('feronikal123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Gizi',
            'about_doctor' => "Dr. Feronika, Sp.GK, is a dedicated specialist in the field of Gizi (nutrition), renowned for her unwavering commitment to promoting health through proper nutrition. With a passion for helping individuals achieve optimal wellness, Dr. Feronika combines her extensive knowledge of nutrition science with a compassionate approach to patient care. She believes in the power of food as medicine and works closely with her patients to develop personalized nutrition plans tailored to their unique needs and goals. Whether it's managing chronic conditions, optimizing athletic performance, or promoting overall well-being, Dr. Feronika empowers her patients to make informed dietary choices that support their health and vitality. With Dr. Feronika's guidance and expertise, individuals can embark on a journey towards better nutrition and a healthier lifestyle.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Devon Wijaya, Sp.Ak',
            'email' => 'devon@gmail.com',
            'password' => bcrypt('devon123'),
            'date_of_birth' => '2002-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Akupuntur',
            'about_doctor' => "Dr. Devon Wijaya, Sp.Ak, is a distinguished specialist in Akupuntur, or acupuncture, renowned for his expertise in this ancient healing art. With a deep understanding of traditional Chinese medicine and modern medical practices, Dr. Devon brings a holistic approach to his practice, focusing on restoring balance and promoting wellness. He is committed to providing compassionate care and empowering his patients to take control of their health through natural healing methods. Dr. Devon's skillful application of acupuncture techniques targets a wide range of conditions, from pain management to stress reduction, and he works closely with each individual to develop personalized treatment plans. Patients can trust in Dr. Devon's extensive experience and dedication to helping them achieve optimal health and vitality through the ancient practice of acupuncture.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Rizky Muhammad, Sp.JP',
            'email' => 'rizky@gmail.com',
            'password' => bcrypt('rizkyl123'),
            'date_of_birth' => '2001-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Jantung',
            'about_doctor' => "Dr. Rizky Muhammad, Sp.JP, is a highly respected specialist in the field of Jantung (cardiology), renowned for his expertise in diagnosing and treating heart-related conditions. With a profound dedication to cardiovascular health, Dr. Rizky combines advanced medical knowledge with a compassionate approach to patient care. He believes in a comprehensive approach to heart health, emphasizing prevention, early detection, and personalized treatment plans tailored to each patient's needs. Whether it's managing hypertension, treating coronary artery disease, or providing cardiac rehabilitation, Dr. Rizky is committed to delivering the highest standard of care to his patients. Patients can trust in Dr. Rizky's expertise and commitment to their well-being, knowing they are in capable hands for their cardiovascular health needs.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Amelia, Sp.THT',
            'email' => 'amelia@gmail.com',
            'password' => bcrypt('amelia123'),
            'date_of_birth' => '1999-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'THT',
            'about_doctor' => "Dr. Amelia, Sp.THT, Sp.JP, is a distinguished specialist in THT (Telinga, Hidung, Tenggorokan), or Ear, Nose, and Throat medicine, as well as Jantung (cardiology). With a wealth of expertise spanning multiple specialties, Dr. Amelia brings a unique and comprehensive approach to her practice. Renowned for her exceptional skill and compassionate care, she is dedicated to providing patients with the highest quality of medical treatment. Whether diagnosing and treating conditions related to the ear, nose, and throat or addressing complex cardiovascular issues, Dr. Amelia is committed to delivering personalized care tailored to each patient's needs. Patients can trust in Dr. Amelia's extensive experience and dedication to their health and well-being, making her a valued and respected member of the medical community.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Robiyanto, Sp.KG',
            'email' => 'robiyano@gmail.com',
            'password' => bcrypt('robiyanto123'),
            'date_of_birth' => '1997-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Gigi',
            'about_doctor' => "Dr. Robiyanto, Sp.KG, is a highly skilled specialist in Gigi (dentistry), dedicated to providing exceptional dental care to his patients. With a focus on excellence and patient satisfaction, Dr. Robiyanto offers a comprehensive range of dental services, from routine cleanings to advanced procedures. Renowned for his gentle approach and attention to detail, he strives to create a comfortable and welcoming environment for every patient. Whether it's addressing cavities, performing root canals, or restoring smiles with cosmetic dentistry, Dr. Robiyanto's expertise and compassion ensure that each patient receives personalized care tailored to their unique needs. Patients can trust in Dr. Robiyanto's commitment to their oral health and well-being, knowing they are in capable hands for all their dental needs.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Richard, Sp.THT',
            'email' => 'richard@gmail.com',
            'password' => bcrypt('richard123'),
            'date_of_birth' => '1970-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'THT',
            'about_doctor' => "Dr. Richard, Sp.THT, is a distinguished specialist in THT (Telinga, Hidung, Tenggorokan), or Ear, Nose, and Throat medicine, renowned for his expertise in diagnosing and treating conditions related to the ear, nose, and throat. With a passion for patient care and a commitment to excellence, Dr. Richard offers comprehensive services to address a wide range of ENT issues. Known for his attentive approach and advanced medical knowledge, he provides personalized treatment plans tailored to each patient's unique needs and concerns. Whether it's managing allergies, treating sinus infections, or performing delicate ear surgeries, Dr. Richard's skill and dedication ensure the highest quality of care for his patients. Patients can trust in Dr. Richard's expertise and compassionate approach, knowing they are in capable hands for their ENT health needs.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Sean Martin, Sp.KG',
            'email' => 'sean@gmail.com',
            'password' => bcrypt('sean123'),
            'date_of_birth' => '1998-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Gigi',
            'about_doctor' => "Dr. Sean Martin, Sp.KG, is a dedicated specialist in Gigi (dentistry), committed to providing top-notch dental care to his patients. With a focus on excellence and patient comfort, Dr. Sean offers a wide array of dental services ranging from routine check-ups to complex procedures. Renowned for his gentle demeanor and meticulous attention to detail, he strives to create a positive and relaxing experience for every patient. Whether it's addressing cavities, performing extractions, or crafting beautiful smiles through cosmetic dentistry, Dr. Sean's expertise and passion ensure optimal oral health outcomes. Patients can trust in Dr. Sean's professionalism and dedication to their dental well-being, making him a trusted choice for all their dental needs.",
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Albert William, Sp.JP',
            'email' => 'albert@gmail.com',
            'password' => bcrypt('albert123'),
            'date_of_birth' => '1989-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Jantung',
            'about_doctor' => "Dr. Albert William, Sp.JP, is a highly regarded specialist in Jantung (cardiology), dedicated to providing exceptional care for heart-related conditions. With a focus on excellence and patient-centered care, Dr. Albert brings extensive expertise to his practice. Renowned for his compassionate approach and commitment to cardiovascular health, he offers comprehensive services ranging from preventive screenings to advanced treatment options. Known for his thorough assessments and personalized treatment plans, Dr. Albert ensures that each patient receives tailored care to address their specific needs and concerns. Whether it's managing hypertension, treating coronary artery disease, or providing cardiac rehabilitation, patients can trust in Dr. Albert's expertise and dedication to their heart health. With Dr. Albert, patients receive the highest standard of care, empowering them to lead healthier lives.",
        ]);
    }
}
