<?php

namespace Tests\Feature;

use App\Models\Libro;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibroTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_or_modify_books(): void
    {
        $libro = Libro::factory()->create();

        foreach (['libros.index', 'libros.create', 'libros.edit'] as $route) {
            $this->get(route($route, $route === 'libros.edit' ? $libro->id : []))
                ->assertRedirect(route('login'));
        }

        $this->post(route('libros.store'), [])->assertRedirect(route('login'));
        $this->put(route('libros.update', $libro->id), [])->assertRedirect(route('login'));
        $this->delete(route('libros.destroy', $libro->id))->assertRedirect(route('login'));
        $this->assertDatabaseCount('libros', 1);
    }

    public function test_users_can_open_the_edit_form_with_the_current_book_data(): void
    {
        $libro = Libro::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('libros.edit', $libro->id))
            ->assertOk()
            ->assertViewIs('libros.edit')
            ->assertSee('Editar libro')
            ->assertSee('action="'.route('libros.update', $libro->id).'"', false)
            ->assertSee('name="_method" value="PUT"', false)
            ->assertSee('value="'.$libro->codigo.'"', false)
            ->assertSee($libro->titulo);
    }

    public function test_users_can_update_a_book_without_changing_its_code(): void
    {
        $libro = Libro::factory()->create();
        $datos = [
            'codigo' => $libro->codigo,
            'titulo' => 'Título actualizado',
            'autor' => 'Autor actualizado',
            'anio_publicacion' => 2020,
        ];

        $this->actingAs(User::factory()->create())
            ->put(route('libros.update', $libro->id), $datos)
            ->assertRedirect(route('libros.index'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('exito', 'Libro actualizado correctamente.');

        $this->assertDatabaseHas('libros', ['id' => $libro->id, ...$datos]);
        $this->get(route('libros.index'))->assertOk()->assertSee('Título actualizado');
    }

    public function test_users_cannot_update_a_book_with_another_books_code(): void
    {
        $libro = Libro::factory()->create();
        $otroLibro = Libro::factory()->create();

        $this->actingAs(User::factory()->create())
            ->from(route('libros.edit', $libro->id))
            ->put(route('libros.update', $libro->id), [
                'codigo' => $otroLibro->codigo,
                'titulo' => $libro->titulo,
                'autor' => $libro->autor,
                'anio_publicacion' => $libro->anio_publicacion,
            ])
            ->assertRedirect(route('libros.edit', $libro->id))
            ->assertSessionHasErrors('codigo');

        $this->assertDatabaseHas('libros', ['id' => $libro->id, 'codigo' => $libro->codigo]);
    }

    public function test_users_can_delete_the_selected_book_from_the_list(): void
    {
        $libro = Libro::factory()->create();
        $otroLibro = Libro::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('libros.index'))
            ->assertOk()
            ->assertSee('action="'.route('libros.destroy', $libro->id).'"', false)
            ->assertSee('name="_method" value="DELETE"', false);

        $this->delete(route('libros.destroy', $libro->id))
            ->assertRedirect(route('libros.index'))
            ->assertSessionHas('exito', 'Libro eliminado correctamente.');

        $this->assertDatabaseMissing('libros', ['id' => $libro->id]);
        $this->assertDatabaseHas('libros', ['id' => $otroLibro->id]);
        $this->get(route('libros.index'))->assertOk()->assertDontSee($libro->codigo);
    }

    public function test_missing_books_return_not_found(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('libros.edit', 999))->assertNotFound();
        $this->put(route('libros.update', 999), [])->assertNotFound();
        $this->delete(route('libros.destroy', 999))->assertNotFound();
    }
}
