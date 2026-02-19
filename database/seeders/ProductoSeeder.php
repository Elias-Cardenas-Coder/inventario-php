<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'name' => 'Laptop ASUS VivoBook',
                'description' => 'Laptop ultradelgada de 15.6 pulgadas, procesador Intel i7, 16GB RAM',
                'category' => 'Electrónica',
                'price' => 5069961.00,
                'stock' => 5,
                'sku' => 'SKU-001',
                'active' => true,
            ],
            [
                'name' => 'Mouse Logitech MX Master',
                'description' => 'Mouse inalámbrico premium con precisión avanzada',
                'category' => 'Accesorios',
                'price' => 389961.00,
                'stock' => 15,
                'sku' => 'SKU-002',
                'active' => true,
            ],
            [
                'name' => 'Teclado Mecánico RGB',
                'description' => 'Teclado mecánico con retroiluminación RGB personalizable',
                'category' => 'Accesorios',
                'price' => 584961.00,
                'stock' => 8,
                'sku' => 'SKU-003',
                'active' => true,
            ],
            [
                'name' => 'Monitor LG UltraWide',
                'description' => 'Monitor 34" ultraancho, resolución 3440x1440',
                'category' => 'Monitores',
                'price' => 2729961.00,
                'stock' => 3,
                'sku' => 'SKU-004',
                'active' => true,
            ],
            [
                'name' => 'Webcam Logitech C920',
                'description' => 'Cámara web Full HD 1080p para videoconferencias',
                'category' => 'Accesorios',
                'price' => 311961.00,
                'stock' => 20,
                'sku' => 'SKU-005',
                'active' => true,
            ],
            [
                'name' => 'Auriculares Sony WH-1000XM4',
                'description' => 'Auriculares inalámbricos con cancelación de ruido activa',
                'category' => 'Audio',
                'price' => 1364961.00,
                'stock' => 7,
                'sku' => 'SKU-006',
                'active' => true,
            ],
            [
                'name' => 'Almacenamiento SSD 1TB',
                'description' => 'Disco SSD NVMe M.2 1TB velocidad 7000MB/s',
                'category' => 'Almacenamiento',
                'price' => 506961.00,
                'stock' => 12,
                'sku' => 'SKU-007',
                'active' => true,
            ],
            [
                'name' => 'Hub USB-C 7 en 1',
                'description' => 'Hub con múltiples puertos: HDMI, USB 3.0, USB-C, SD',
                'category' => 'Accesorios',
                'price' => 233961.00,
                'stock' => 25,
                'sku' => 'SKU-008',
                'active' => true,
            ],
            [
                'name' => 'Cable HDMI 2.1',
                'description' => 'Cable HDMI 2.1 de 2 metros, soporta 8K',
                'category' => 'Cables',
                'price' => 116961.00,
                'stock' => 50,
                'sku' => 'SKU-009',
                'active' => true,
            ],
            [
                'name' => 'Fuente de Poder 850W',
                'description' => 'Fuente modular 850W 80+ Gold, eficiencia 90%',
                'category' => 'Componentes',
                'price' => 740961.00,
                'stock' => 4,
                'sku' => 'SKU-010',
                'active' => true,
            ],
            [
                'name' => 'Tarjeta Gráfica RTX 4090',
                'description' => 'GPU Nvidia RTX 4090 24GB GDDR6X',
                'category' => 'Componentes',
                'price' => 7019961.00,
                'stock' => 2,
                'sku' => 'SKU-011',
                'active' => true,
            ],
            [
                'name' => 'Procesador Intel i9-13900K',
                'description' => 'CPU Intel i9 13ª generación 24 núcleos',
                'category' => 'Componentes',
                'price' => 2729961.00,
                'stock' => 6,
                'sku' => 'SKU-012',
                'active' => true,
            ],
            [
                'name' => 'Memoria RAM 32GB DDR5',
                'description' => 'Módulo de RAM DDR5 32GB 6000MHz',
                'category' => 'Componentes',
                'price' => 974961.00,
                'stock' => 18,
                'sku' => 'SKU-013',
                'active' => true,
            ],
            [
                'name' => 'Placa Base ASUS ROG Z790',
                'description' => 'Motherboard ASUS ROG Z790 para Intel',
                'category' => 'Componentes',
                'price' => 1754961.00,
                'stock' => 5,
                'sku' => 'SKU-014',
                'active' => true,
            ],
            [
                'name' => 'Enfriador de CPU Noctua NH-D15',
                'description' => 'Cooler de aire premium para CPU',
                'category' => 'Refrigeración',
                'price' => 428961.00,
                'stock' => 10,
                'sku' => 'SKU-015',
                'active' => true,
            ],
            [
                'name' => 'Gabinete Corsair Crystal 570X',
                'description' => 'Case ATX con panel de cristal templado',
                'category' => 'Gabinetes',
                'price' => 701961.00,
                'stock' => 8,
                'sku' => 'SKU-016',
                'active' => true,
            ],
            [
                'name' => 'Monitor ASUS PG279Q 27"',
                'description' => 'Monitor IPS 1440p 165Hz gaming profesional',
                'category' => 'Monitores',
                'price' => 2144961.00,
                'stock' => 4,
                'sku' => 'SKU-017',
                'active' => true,
            ],
            [
                'name' => 'Pad para Ratón SteelSeries',
                'description' => 'Mousepad extra grande 900x400mm',
                'category' => 'Accesorios',
                'price' => 155961.00,
                'stock' => 30,
                'sku' => 'SKU-018',
                'active' => true,
            ],
            [
                'name' => 'Adaptador Thunderbolt 3',
                'description' => 'Adaptador USB-C a Thunderbolt 3',
                'category' => 'Cables',
                'price' => 194961.00,
                'stock' => 16,
                'sku' => 'SKU-019',
                'active' => true,
            ],
            [
                'name' => 'Protector Pantalla Anti-Azul',
                'description' => 'Lámina protectora para monitor 27"',
                'category' => 'Accesorios',
                'price' => 77961.00,
                'stock' => 45,
                'sku' => 'SKU-020',
                'active' => true,
            ],
        ];

        // Obtener el usuario administrador para asignar los productos
        $adminUser = \App\Models\User::where('email', 'admin@admin.com')->first();

        if (!$adminUser) {
            $this->command->error('No se encontró el usuario administrador. Ejecuta AdminUserSeeder primero.');
            return;
        }

        foreach ($productos as $producto) {
            $producto['user_id'] = $adminUser->id;
            Producto::create($producto);
        }

        $this->command->info('Se crearon ' . count($productos) . ' productos para el usuario administrador.');
    }
}
