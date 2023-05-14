<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;

class QuizResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $results;
    public $pdf;

    public function __construct($data, $results, $pdf)
    {
        $this->data = $data;
        $this->results = $results;
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Quiz Result Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'quiz.result-pdf',
        );
    }

    public function build()
    {
        return $this->view('quiz.result-pdf')
            ->with('data', $this->data)
            ->with('results', $this->results)
            ->attachData($this->pdf(), 'quiz_result.pdf');
    }


    protected function pdf()
    {
        return PDF::loadView('quiz.result-pdf', ['data' => $this->data, 'results' => $this->results])
            ->output();
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
