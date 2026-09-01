<?php

namespace App\Models;

use App\Entities\ContactMessage;
use CodeIgniter\Model;

/** Messages left through the "contact us" form. */
class ContactMessageModel extends Model
{
    protected $table         = 'contact_messages';
    protected $primaryKey    = 'id';
    protected $returnType    = ContactMessage::class;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $allowedFields = ['name', 'email', 'body', 'is_read'];

    protected $validationRules = [
        'name'  => 'trim|required|min_length[5]|max_length[100]',
        'email' => 'trim|required|valid_email|max_length[100]',
        'body'  => 'trim|required|min_length[30]|max_length[500]',
    ];

    protected $validationMessages = [
        'name'  => ['required' => 'You have not provided your full name.'],
        'email' => ['valid_email' => 'You did not provide a valid e-mail address.'],
        'body'  => ['min_length' => 'Your message must be at least 30 characters long.'],
    ];

    public function latest(): array
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function unreadCount(): int
    {
        return $this->where('is_read', 0)->countAllResults();
    }

    public function markRead(int $messageId): bool
    {
        return $this->update($messageId, ['is_read' => 1]);
    }
}
