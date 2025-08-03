import React from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Plus, Edit, Trash2, Eye, MapPin } from 'lucide-react';

interface Accommodation {
    id: number;
    name: string;
    type: string;
    address: string;
    price_from: number | null;
    is_active: boolean;
    facilities: Array<{ name: string }>;
    room_types: Array<{ name: string }>;
}

interface Props {
    accommodations: {
        data: Accommodation[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        meta: {
            total: number;
            last_page: number;
        };
    };
    [key: string]: unknown;
}

const typeLabels = {
    hotel: '🏨 Hotel',
    inn: '🏡 Inn',
    house: '🏠 House'
};

export default function AdminAccommodationIndex({ accommodations }: Props) {
    const handleDelete = (accommodation: Accommodation) => {
        if (confirm(`Are you sure you want to delete ${accommodation.name}?`)) {
            router.delete(route('admin.accommodations.destroy', accommodation.id), {
                preserveScroll: true,
            });
        }
    };

    return (
        <AppShell>
            <Head title="Manage Accommodations" />

            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900">Accommodations</h1>
                        <p className="text-gray-600">Manage your property listings</p>
                    </div>
                    <Link
                        href={route('admin.accommodations.create')}
                        className="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
                    >
                        <Plus className="w-4 h-4" />
                        Add Property
                    </Link>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {accommodations.data.map((accommodation) => (
                        <Card key={accommodation.id} className="overflow-hidden">
                            <CardHeader>
                                <div className="flex items-start justify-between">
                                    <div className="flex-1">
                                        <CardTitle className="text-lg line-clamp-1">
                                            {accommodation.name}
                                        </CardTitle>
                                        <CardDescription className="flex items-center mt-1">
                                            <MapPin className="w-4 h-4 mr-1" />
                                            {accommodation.address}
                                        </CardDescription>
                                    </div>
                                    <div className="flex items-center gap-2">
                                        <Badge 
                                            variant={accommodation.is_active ? "default" : "secondary"}
                                            className="text-xs"
                                        >
                                            {accommodation.is_active ? 'Active' : 'Inactive'}
                                        </Badge>
                                        <Badge variant="outline" className="text-xs">
                                            {typeLabels[accommodation.type as keyof typeof typeLabels]}
                                        </Badge>
                                    </div>
                                </div>
                            </CardHeader>

                            <CardContent>
                                <div className="space-y-3">
                                    {accommodation.price_from && (
                                        <div className="text-lg font-semibold text-indigo-600">
                                            From ${accommodation.price_from}/night
                                        </div>
                                    )}

                                    <div className="flex items-center justify-between text-sm text-gray-600">
                                        <span>{accommodation.facilities.length} facilities</span>
                                        <span>{accommodation.room_types.length} room types</span>
                                    </div>

                                    <div className="flex items-center gap-2">
                                        <Link
                                            href={route('accommodations.show', accommodation.id)}
                                            className="flex items-center gap-1 text-indigo-600 hover:text-indigo-700 text-sm"
                                        >
                                            <Eye className="w-4 h-4" />
                                            View
                                        </Link>
                                        
                                        <Link
                                            href={route('admin.accommodations.edit', accommodation.id)}
                                            className="flex items-center gap-1 text-gray-600 hover:text-gray-700 text-sm"
                                        >
                                            <Edit className="w-4 h-4" />
                                            Edit
                                        </Link>
                                        
                                        <button
                                            onClick={() => handleDelete(accommodation)}
                                            className="flex items-center gap-1 text-red-600 hover:text-red-700 text-sm"
                                        >
                                            <Trash2 className="w-4 h-4" />
                                            Delete
                                        </button>

                                        <Link
                                            href={route('admin.accommodations.room-types.index', accommodation.id)}
                                            className="flex items-center gap-1 text-green-600 hover:text-green-700 text-sm ml-auto"
                                        >
                                            Rooms
                                        </Link>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {accommodations.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-6xl mb-4">🏨</div>
                        <h3 className="text-xl font-semibold text-gray-900 mb-2">
                            No accommodations yet
                        </h3>
                        <p className="text-gray-600 mb-4">
                            Get started by adding your first property listing.
                        </p>
                        <Link
                            href={route('admin.accommodations.create')}
                            className="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
                        >
                            <Plus className="w-4 h-4" />
                            Add Your First Property
                        </Link>
                    </div>
                )}

                {/* Pagination */}
                {accommodations.meta.last_page > 1 && (
                    <div className="flex justify-center">
                        <div className="flex items-center space-x-1">
                            {accommodations.links.map((link, index: number) => (
                                <Button
                                    key={index}
                                    variant={link.active ? "default" : "outline"}
                                    size="sm"
                                    onClick={() => link.url && router.visit(link.url)}
                                    disabled={!link.url}
                                    className="min-w-[40px]"
                                >
                                    <span dangerouslySetInnerHTML={{ __html: link.label }} />
                                </Button>
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppShell>
    );
}