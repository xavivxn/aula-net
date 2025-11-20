<?php
class Clase {
    public $titulo;
    public $descripcion;
    public $profesor;
    public $imagen;
    public $categoria;
    
    public function __construct($titulo, $descripcion, $profesor, $imagen = '', $categoria = 'General') {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->profesor = $profesor;
        $this->imagen = $imagen;
        $this->categoria = $categoria;
    }
}

class ClasesPopulares {
    private $clases = [];
    
    public function __construct() {
        $this->inicializarClases();
    }
    
    private function inicializarClases() {
        $this->clases = [
            new Clase(
                "Programación Web Full Stack",
                "Aprende a crear aplicaciones web completas desde cero. HTML, CSS, JavaScript, PHP y bases de datos.",
                "Dr. Carlos Mendoza",
                "programming.jpg",
                "Tecnología"
            ),
            new Clase(
                "Machine Learning e IA",
                "Domina los algoritmos de aprendizaje automático y crea sistemas inteligentes con Python.",
                "Dra. Ana García",
                "machine-learning.jpg",
                "Tecnología"
            ),
            new Clase(
                "Guitarra Clásica y Moderna",
                "Desde acordes básicos hasta técnicas avanzadas. Aprende tu género musical favorito.",
                "Maestro Luis Rodríguez",
                "guitar.jpg",
                "Música"
            ),
            new Clase(
                "Piano para Principiantes",
                "Inicia tu camino musical con el piano. Teoría musical y práctica desde lo básico.",
                "Profesora María Elena",
                "piano.jpg",
                "Música"
            ),
            new Clase(
                "Química Orgánica",
                "Comprende las reacciones y estructuras de los compuestos orgánicos de manera práctica.",
                "Dr. Roberto Silva",
                "chemistry.jpg",
                "Ciencias"
            ),
            new Clase(
                "Física Cuántica",
                "Explora los misterios del universo subatómico y sus aplicaciones modernas.",
                "Dr. Patricia López",
                "physics.jpg",
                "Ciencias"
            ),
            new Clase(
                "Matemáticas Avanzadas",
                "Cálculo diferencial e integral, álgebra lineal y ecuaciones diferenciales.",
                "Prof. Miguel Torres",
                "mathematics.jpg",
                "Ciencias"
            ),
            new Clase(
                "Inglés Conversacional",
                "Mejora tu fluidez en inglés con clases dinámicas y conversación práctica.",
                "Teacher Sarah Johnson",
                "english.jpg",
                "Idiomas"
            ),
            new Clase(
                "Diseño Gráfico Digital",
                "Photoshop, Illustrator y principios de diseño para crear proyectos profesionales.",
                "Diseñadora Laura Vega",
                "design.jpg",
                "Arte y Diseño"
            ),
            new Clase(
                "Cocina Internacional",
                "Aprende técnicas culinarias de diferentes culturas y crea platos deliciosos.",
                "Chef Antonio Morales",
                "cooking.jpg",
                "Gastronomía"
            )
        ];
    }
    
    public function obtenerClases() {
        return $this->clases;
    }
    
    public function obtenerClasesPorCategoria($categoria) {
        return array_filter($this->clases, function($clase) use ($categoria) {
            return $clase->categoria === $categoria;
        });
    }
    
    public function obtenerCategorias() {
        $categorias = array_unique(array_map(function($clase) {
            return $clase->categoria;
        }, $this->clases));
        return array_values($categorias);
    }
}
?>