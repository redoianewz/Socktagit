<?php

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

// وظيفة لتعديل ملفات الـ views
function modifyViewFiles()
{
    // حدد مسار الملف الذي تريد تعديله
    $filePath = __DIR__ . '/resources/views/welcome.blade.php'; // يمكنك تعديل المسار وفقًا لاحتياجاتك

    // نص التعديل الذي تريده
    $newContent = "\n<!-- تعديل تلقائي تم بواسطة controllerpush.php -->\n";

    // قراءة محتوى الملف
    $currentContent = file_get_contents($filePath);

    // تعديل المحتوى
    $updatedContent = $currentContent . $newContent;

    // كتابة المحتوى الجديد في الملف
    file_put_contents($filePath, $updatedContent);
}

// وظيفة لتنفيذ أوامر Git
function gitPush()
{
    // مسار مجلد المشروع (المجلد الحالي)
    $path = __DIR__;

    // الأوامر التي نريد تنفيذها
    $commands = [
        'git add .', // إضافة جميع الملفات
        'git commit -m "Auto commit by controllerpush.php"', // إنشاء commit
        'git push' // دفع التغييرات إلى GitHub
    ];

    foreach ($commands as $command) {
        // إنشاء عملية جديدة لتنفيذ الأمر
        $process = Process::fromShellCommandline($command, $path);

        // تشغيل العملية
        $process->run();

        // التحقق مما إذا كانت العملية قد فشلت
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // طباعة الإخراج للديباغة
        echo $process->getOutput();
    }
}

// تنفيذ تعديل الـ views
modifyViewFiles();

// تنفيذ الـ Git push
gitPush();

echo "Views modified and pushed to GitHub successfully.\n";
