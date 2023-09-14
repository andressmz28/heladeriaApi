<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function registrarUsuario(Request $request)
    {
        try {
            // Validar los datos del formulario aquí

            $usuario = new Usuario();
            $usuario->nombre = $request->input('nombre');
            $usuario->correo = $request->input('correo');
            $usuario->contrasena = $request->input('contrasena'); // Encripta la contraseña
            $usuario->permiso_id = 2;

            $usuario->save();

            return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function delete($id)
    {
        $dulce = Usuario::find($id);
        if ($dulce) {
            $dulce->delete();
            return response()->json(['message' => 'Eliminado correctamente'], 201);
        } else {
            return response()->json(['error' => 'No existe ese id'], 401);
        }
    }

    public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Usuario();
        $create->nombre = $data['nombre'];
        $create->correo = $data['correo'];
        $create->contrasena = $data['contrasena'];
        $create->permiso_id = $data['permiso_id'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Usuario::find($id);
        $update->nombre = $data['nombre'];
        $update->correo = $data['correo'];
        $update->contrasena = $data['contrasena'];
        $update->permiso_id = $data['permiso_id'];

        $update->save();
        return response()->json($update, 201);
    }


    public function login(Request $request)
    {
        $data = $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required|string',
        ]);

        $correo = $data['correo'];
        $contrasena = $data['contrasena'];

        $usuario = Usuario::where('correo', $correo)
            ->where('contrasena', $contrasena)
            ->first();

        if ($usuario) {
            // Credenciales correctas
            return response()->json(['message' => 'Inicio de sesión exitoso', 'usuario' => $usuario], 200);
        } else {
            // Credenciales incorrectas
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
    }

    public function getUserPedidos()
    {
        $usuariosConTotalPedidos = Usuario::select('users.id as user_id', 'users.nombre as user_nombre')
    ->withCount(['pedidos' => function ($query) {
        $query->where('atendido', 0); // Filtrar pedidos no atendidos.
    }])
    ->has('pedidos', '>', 0) // Esto asegura que solo se incluyan usuarios que tengan pedidos.
    ->having('pedidos_count', '>', 0) // Esto excluye a los usuarios con pedidos_count igual a 0.
    ->selectSub(function ($query) {
        // Subconsulta para calcular la suma de dinero de los pedidos
        $query->selectRaw('SUM(h.precio + IFNULL((SELECT SUM(du.precio) FROM dulce_pedido dp LEFT JOIN dulces du ON dp.dulce_id = du.id WHERE dp.pedido_id = pedidos.id), 0) + IFNULL((SELECT SUM(fr.precio) FROM fruta_pedido fp LEFT JOIN frutas fr ON fp.fruta_id = fr.id WHERE fp.pedido_id = pedidos.id), 0) + IFNULL((SELECT SUM(e.precio) FROM especial_pedido ep LEFT JOIN especiales e ON ep.especial_id = e.id WHERE ep.pedido_id = pedidos.id), 0) + IFNULL((SELECT SUM(l.precio) FROM licor_pedido lp LEFT JOIN licor l ON lp.licor_id = l.id WHERE lp.pedido_id = pedidos.id), 0) + IFNULL((SELECT SUM(s.precio) FROM salsa_pedido sp LEFT JOIN salsas s ON sp.salsa_id = s.id WHERE sp.pedido_id = pedidos.id), 0) + IFNULL((SELECT SUM(t.precio) FROM toping_pedido tp LEFT JOIN topings t ON tp.toping_id = t.id WHERE tp.pedido_id = pedidos.id), 0))')
            ->from('pedidos')
            ->leftJoin('helados as h', 'pedidos.helado_id', '=', 'h.id')
            ->whereColumn('pedidos.user_id', 'users.id')
            ->where('pedidos.atendido', 0);
    }, 'total_dinero_pedidos')
    ->get();

return response()->json($usuariosConTotalPedidos);

    }

}
