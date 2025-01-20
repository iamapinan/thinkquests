<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Content;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_delete_content_with_files()
    {
        Storage::fake('local');

        // สร้างไฟล์จำลอง
        $file = UploadedFile::fake()->create('document.pdf', 100);
        $image = UploadedFile::fake()->image('thumbnail.jpg');

        // สร้าง content ทดสอบ
        $content = Content::factory()->create([
            'file_path' => $file->store('documents'),
            'image_path' => $image->store('images')
        ]);

        // ทดสอบการลบ
        $response = $this->deleteJson("/content/{$content->id}");

        $response->assertStatus(200)
                 ->assertJson(['success' => true]);

        // ตรวจสอบว่าไฟล์ถูกลบ
        Storage::assertMissing($content->file_path);
        Storage::assertMissing($content->image_path);
        
        // ตรวจสอบว่าข้อมูลถูกลบจากฐานข้อมูล
        $this->assertDatabaseMissing('contents', ['id' => $content->id]);
    }

    public function test_returns_error_for_nonexistent_content()
    {
        $response = $this->deleteJson("/content/99999");
        
        $response->assertStatus(404);
    }
} 