<?php

namespace Tests\Feature;

use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
    }

    // ── Auth ──────────────────────────────────────────────────────────────────

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    }

    public function test_guest_is_redirected_from_admin_root(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
    }

    public function test_login_page_loads(): void
    {
        $this->get(route('admin.login'))->assertOk()->assertViewIs('admin.auth.login');
    }

    public function test_login_with_valid_credentials(): void
    {
        $this->post(route('admin.login.post'), [
            'email'    => $this->admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));
    }

    public function test_login_with_invalid_credentials(): void
    {
        $this->post(route('admin.login.post'), [
            'email'    => $this->admin->email,
            'password' => 'wrong',
        ])->assertSessionHasErrors('email');
    }

    public function test_logout_redirects_to_login(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));
    }

    // ── Dashboard ────────────────────────────────────────────────────────────

    public function test_dashboard_loads_for_authenticated_user(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertViewIs('admin.dashboard')
            ->assertViewHas('stats')
            ->assertViewHas('recentProjects');
    }

    public function test_dashboard_shows_correct_counts(): void
    {
        Project::factory()->count(3)->create();
        Skill::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $stats = $response->viewData('stats');
        $this->assertEquals(3, $stats['projects']);
        $this->assertEquals(5, $stats['skills']);
    }

    // ── Projects ─────────────────────────────────────────────────────────────

    public function test_projects_index_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.projects.index'))
            ->assertOk()
            ->assertViewIs('admin.projects.index');
    }

    public function test_projects_create_page_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.projects.create'))
            ->assertOk()
            ->assertViewIs('admin.projects.create');
    }

    public function test_projects_store_creates_record(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.projects.store'), [
                'title'       => 'Test Project',
                'description' => 'Test description',
                'category'    => 'web',
                'tech_tags'   => 'Laravel, Vue.js',
                'sort_order'  => 1,
            ])
            ->assertRedirect(route('admin.projects.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('projects', ['title' => 'Test Project']);
    }

    public function test_projects_store_validation_fails_without_required_fields(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.projects.store'), [])
            ->assertSessionHasErrors(['title', 'description', 'category']);
    }

    public function test_projects_edit_page_loads(): void
    {
        $project = Project::factory()->create();

        $this->actingAs($this->admin)
            ->get(route('admin.projects.edit', $project))
            ->assertOk()
            ->assertViewIs('admin.projects.edit')
            ->assertViewHas('project', $project);
    }

    public function test_projects_update_modifies_record(): void
    {
        $project = Project::factory()->create(['title' => 'Old Title']);

        $this->actingAs($this->admin)
            ->put(route('admin.projects.update', $project), [
                'title'       => 'New Title',
                'description' => 'Updated desc',
                'category'    => 'web',
            ])
            ->assertRedirect(route('admin.projects.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('projects', ['id' => $project->id, 'title' => 'New Title']);
    }

    public function test_projects_destroy_deletes_record(): void
    {
        $project = Project::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.projects.destroy', $project))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    // ── Skills ───────────────────────────────────────────────────────────────

    public function test_skills_index_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.skills.index'))
            ->assertOk()
            ->assertViewIs('admin.skills.index');
    }

    public function test_skills_create_page_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.skills.create'))
            ->assertOk()
            ->assertViewIs('admin.skills.create');
    }

    public function test_skills_store_creates_record(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.skills.store'), [
                'name'       => 'Laravel',
                'category'   => 'backend',
                'level'      => 95,
                'sort_order' => 1,
            ])
            ->assertRedirect(route('admin.skills.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('skills', ['name' => 'Laravel']);
    }

    public function test_skills_store_validation_fails(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.skills.store'), ['name' => 'X', 'category' => 'invalid', 'level' => 200])
            ->assertSessionHasErrors(['category', 'level']);
    }

    public function test_skills_edit_page_loads(): void
    {
        $skill = Skill::factory()->create();

        $this->actingAs($this->admin)
            ->get(route('admin.skills.edit', $skill))
            ->assertOk()
            ->assertViewIs('admin.skills.edit')
            ->assertViewHas('skill', $skill);
    }

    public function test_skills_update_modifies_record(): void
    {
        $skill = Skill::factory()->create(['name' => 'Old Skill']);

        $this->actingAs($this->admin)
            ->put(route('admin.skills.update', $skill), [
                'name'     => 'New Skill',
                'category' => 'frontend',
                'level'    => 80,
            ])
            ->assertRedirect(route('admin.skills.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('skills', ['id' => $skill->id, 'name' => 'New Skill']);
    }

    public function test_skills_destroy_deletes_record(): void
    {
        $skill = Skill::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.skills.destroy', $skill))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('skills', ['id' => $skill->id]);
    }

    // ── Experiences ──────────────────────────────────────────────────────────

    public function test_experiences_index_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.experiences.index'))
            ->assertOk()
            ->assertViewIs('admin.experiences.index');
    }

    public function test_experiences_create_page_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.experiences.create'))
            ->assertOk()
            ->assertViewIs('admin.experiences.create');
    }

    public function test_experiences_store_creates_record(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.experiences.store'), [
                'role'        => 'Senior Developer',
                'company'     => 'Acme Corp',
                'location'    => 'Remote',
                'duration'    => '2 years',
                'type'        => 'full-time',
                'description' => 'Built stuff.',
                'sort_order'  => 1,
            ])
            ->assertRedirect(route('admin.experiences.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('experiences', ['role' => 'Senior Developer', 'company' => 'Acme Corp']);
    }

    public function test_experiences_store_validation_fails(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.experiences.store'), [])
            ->assertSessionHasErrors(['role', 'company']);
    }

    public function test_experiences_edit_page_loads(): void
    {
        $experience = Experience::factory()->create();

        $this->actingAs($this->admin)
            ->get(route('admin.experiences.edit', $experience))
            ->assertOk()
            ->assertViewIs('admin.experiences.edit')
            ->assertViewHas('experience', $experience);
    }

    public function test_experiences_update_modifies_record(): void
    {
        $experience = Experience::factory()->create(['role' => 'Old Role']);

        $this->actingAs($this->admin)
            ->put(route('admin.experiences.update', $experience), [
                'role'    => 'New Role',
                'company' => 'New Corp',
            ])
            ->assertRedirect(route('admin.experiences.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('experiences', ['id' => $experience->id, 'role' => 'New Role']);
    }

    public function test_experiences_destroy_deletes_record(): void
    {
        $experience = Experience::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.experiences.destroy', $experience))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('experiences', ['id' => $experience->id]);
    }

    // ── Education ────────────────────────────────────────────────────────────

    public function test_education_index_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.education.index'))
            ->assertOk()
            ->assertViewIs('admin.education.index');
    }

    public function test_education_create_page_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.education.create'))
            ->assertOk()
            ->assertViewIs('admin.education.create');
    }

    public function test_education_store_creates_record(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.education.store'), [
                'degree'      => 'BSc Computer Science',
                'institution' => 'State University',
                'year'        => '2020',
                'location'    => 'Cairo',
                'sort_order'  => 1,
            ])
            ->assertRedirect(route('admin.education.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('educations', ['degree' => 'BSc Computer Science']);
    }

    public function test_education_store_validation_fails(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.education.store'), [])
            ->assertSessionHasErrors(['degree', 'institution']);
    }

    public function test_education_edit_page_loads(): void
    {
        $education = Education::factory()->create();

        $this->actingAs($this->admin)
            ->get(route('admin.education.edit', $education))
            ->assertOk()
            ->assertViewIs('admin.education.edit')
            ->assertViewHas('education', $education);
    }

    public function test_education_update_modifies_record(): void
    {
        $education = Education::factory()->create(['degree' => 'Old Degree']);

        $this->actingAs($this->admin)
            ->put(route('admin.education.update', $education), [
                'degree'      => 'New Degree',
                'institution' => 'New Uni',
            ])
            ->assertRedirect(route('admin.education.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('educations', ['id' => $education->id, 'degree' => 'New Degree']);
    }

    public function test_education_destroy_deletes_record(): void
    {
        $education = Education::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.education.destroy', $education))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('educations', ['id' => $education->id]);
    }

    // ── Certifications ───────────────────────────────────────────────────────

    public function test_certifications_index_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.certifications.index'))
            ->assertOk()
            ->assertViewIs('admin.certifications.index');
    }

    public function test_certifications_create_page_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.certifications.create'))
            ->assertOk()
            ->assertViewIs('admin.certifications.create');
    }

    public function test_certifications_store_creates_record(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.certifications.store'), [
                'title'      => 'AWS Certified',
                'issuer'     => 'Amazon',
                'date'       => 'Jan 2024',
                'url'        => 'https://example.com/cert',
                'sort_order' => 1,
            ])
            ->assertRedirect(route('admin.certifications.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('certifications', ['title' => 'AWS Certified']);
    }

    public function test_certifications_store_validation_fails(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.certifications.store'), [])
            ->assertSessionHasErrors(['title', 'issuer']);
    }

    public function test_certifications_edit_page_loads(): void
    {
        $cert = Certification::factory()->create();

        $this->actingAs($this->admin)
            ->get(route('admin.certifications.edit', $cert))
            ->assertOk()
            ->assertViewIs('admin.certifications.edit')
            ->assertViewHas('certification', $cert);
    }

    public function test_certifications_update_modifies_record(): void
    {
        $cert = Certification::factory()->create(['title' => 'Old Cert']);

        $this->actingAs($this->admin)
            ->put(route('admin.certifications.update', $cert), [
                'title'  => 'New Cert',
                'issuer' => 'New Issuer',
            ])
            ->assertRedirect(route('admin.certifications.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('certifications', ['id' => $cert->id, 'title' => 'New Cert']);
    }

    public function test_certifications_destroy_deletes_record(): void
    {
        $cert = Certification::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.certifications.destroy', $cert))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('certifications', ['id' => $cert->id]);
    }

    // ── Testimonials ─────────────────────────────────────────────────────────

    public function test_testimonials_index_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.testimonials.index'))
            ->assertOk()
            ->assertViewIs('admin.testimonials.index');
    }

    public function test_testimonials_create_page_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.testimonials.create'))
            ->assertOk()
            ->assertViewIs('admin.testimonials.create');
    }

    public function test_testimonials_store_creates_record(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.testimonials.store'), [
                'name'       => 'John Doe',
                'role'       => 'CEO',
                'company'    => 'Acme Corp',
                'quote'      => 'Outstanding developer!',
                'sort_order' => 1,
            ])
            ->assertRedirect(route('admin.testimonials.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('testimonials', ['name' => 'John Doe', 'quote' => 'Outstanding developer!']);
    }

    public function test_testimonials_store_validation_fails(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.testimonials.store'), [])
            ->assertSessionHasErrors(['name', 'quote']);
    }

    public function test_testimonials_edit_page_loads(): void
    {
        $testimonial = Testimonial::factory()->create();

        $this->actingAs($this->admin)
            ->get(route('admin.testimonials.edit', $testimonial))
            ->assertOk()
            ->assertViewIs('admin.testimonials.edit')
            ->assertViewHas('testimonial', $testimonial);
    }

    public function test_testimonials_update_modifies_record(): void
    {
        $testimonial = Testimonial::factory()->create(['name' => 'Old Name', 'quote' => 'Old quote']);

        $this->actingAs($this->admin)
            ->put(route('admin.testimonials.update', $testimonial), [
                'name'  => 'New Name',
                'quote' => 'New quote',
            ])
            ->assertRedirect(route('admin.testimonials.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('testimonials', ['id' => $testimonial->id, 'name' => 'New Name']);
    }

    public function test_testimonials_destroy_deletes_record(): void
    {
        $testimonial = Testimonial::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.testimonials.destroy', $testimonial))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }

    // ── Settings ─────────────────────────────────────────────────────────────

    public function test_settings_index_loads(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.settings.index'))
            ->assertOk()
            ->assertViewIs('admin.settings.index')
            ->assertViewHas('settings');
    }

    public function test_settings_update_saves_values(): void
    {
        Setting::updateOrCreate(['key' => 'name'], ['value' => 'Old Name']);

        $this->actingAs($this->admin)
            ->post(route('admin.settings.update'), [
                'name'  => 'Ahmed Al-Sir',
                'title' => 'Senior Engineer',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('settings', ['key' => 'name', 'value' => 'Ahmed Al-Sir']);
        $this->assertDatabaseHas('settings', ['key' => 'title', 'value' => 'Senior Engineer']);
    }
}
