<?php

namespace Tests\Feature;

use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    public function test_index_page_loads_correctly()
    {
        $this->actingAs($this->admin); // Act as admin

        $response = $this->get(route('tasks'));

        $response->assertStatus(200)
            ->assertViewIs('task.index')
            ->assertSee('Tasks');
    }

    public function test_create_page_loads_correctly()
    {
        $this->actingAs($this->admin); // Act as admin

        $response = $this->get(route('task.create'));

        $response->assertStatus(200)
            ->assertViewIs('task.create')
            ->assertSee('Create Task');
    }

    public function test_store_method_creates_new_task()
    {
        $this->actingAs($this->admin); // Act as admin

        $user = User::factory()->create();

        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'admin_id' => $this->admin->id,
            'user_id' => $user->id,
        ];


        $response = $this->post(route('task.store'), $data);
        $response->assertRedirect(route('tasks', ['page' => 2]))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_statistics_method_returns_correct_data()
    {
        $this->actingAs($this->admin); // Act as admin

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Task::factory()->create(['user_id' => $user1->id]);
        Task::factory()->create(['user_id' => $user1->id]);
        Task::factory()->create(['user_id' => $user2->id]);

        $response = $this->get(route('tasks.statistics'));

        $response->assertStatus(200)
            ->assertViewIs('task.statistics')
            ->assertSee('Statistics')
            ->assertSee($user1->name)
            ->assertSee($user2->name);
    }
}
