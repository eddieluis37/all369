<?php

namespace App\Mail;

use App\Models\Documents\Signature;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SignedDocument extends Mailable
{
    use Queueable, SerializesModels;

    public $signature;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Signature $signature)
    {
        $this->signature = $signature;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "{$this->signature->type->name} - {$this->signature->subject}";
        $file = Storage::disk('gcs')->get($this->signature->signaturesFileDocument->signed_file);

        $email = $this->view('documents.signatures.mails.signed_notification_recipients')
            ->subject($subject)
            ->attachData($file, "{$this->signature->type->name}.pdf", ['mime' => 'application/pdf']);

        foreach ($this->signature->signaturesFileAnexos as $key => $signaturesFileAnexo) {
            $email->attachFromStorageDisk('gcs', $signaturesFileAnexo->file, 'anexo_' . $key . '.pdf', ['mime' => 'application/pdf']);
        }

        return $email;
    }
}
