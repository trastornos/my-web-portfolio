// Función que filtra y organiza una lista de usuarios según su edad y nombre
function filtrarYOrdenarUsuarios(usuarios) {
    // Filtrar usuarios mayores de 18 años
    const usuariosMayores = usuarios.filter(usuario => usuario.edad > 18);

    // Ordenar los usuarios alfabéticamente por su nombre
    const usuariosOrdenados = usuariosMayores.sort((a, b) => a.nombre.localeCompare(b.nombre));

    return usuariosOrdenados;
}

// Datos de ejemplo
const usuarios = [
    { nombre: 'Carlos', edad: 17 },
    { nombre: 'Ana', edad: 25 },
    { nombre: 'Luis', edad: 32 },
    { nombre: 'Marta', edad: 22 },
    { nombre: 'Pedro', edad: 19 }
];

// Ejecutando la función
console.log(filtrarYOrdenarUsuarios(usuarios));
