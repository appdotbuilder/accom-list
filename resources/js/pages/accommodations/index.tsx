import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Checkbox } from '@/components/ui/checkbox';
import { MapPin, Search, Filter } from 'lucide-react';

interface Accommodation {
    id: number;
    name: string;
    type: string;
    description: string;
    address: string;
    price_from: number;
    featured_image: string | null;
    facilities: Array<{
        id: number;
        name: string;
        icon: string | null;
    }>;
}

interface Facility {
    id: number;
    name: string;
    icon: string | null;
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
    facilities: Facility[];
    filters: {
        search?: string;
        type?: string;
        min_price?: string;
        max_price?: string;
        facilities?: number[];
    };
    [key: string]: unknown;
}

const typeLabels = {
    hotel: '🏨 Hotel',
    inn: '🏡 Inn',
    house: '🏠 House'
};



export default function AccommodationIndex({ accommodations, facilities, filters }: Props) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');
    const [selectedType, setSelectedType] = useState(filters.type || 'all');
    const [minPrice, setMinPrice] = useState(filters.min_price || '');
    const [maxPrice, setMaxPrice] = useState(filters.max_price || '');
    const [selectedFacilities, setSelectedFacilities] = useState<number[]>(filters.facilities || []);
    const [showFilters, setShowFilters] = useState(false);

    const handleSearch = () => {
        router.get(route('accommodations.index'), {
            search: searchTerm,
            type: selectedType === 'all' ? '' : selectedType,
            min_price: minPrice,
            max_price: maxPrice,
            facilities: selectedFacilities,
        }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const clearFilters = () => {
        setSearchTerm('');
        setSelectedType('all');
        setMinPrice('');
        setMaxPrice('');
        setSelectedFacilities([]);
        router.get(route('accommodations.index'));
    };

    const handleFacilityChange = (facilityId: number, checked: boolean) => {
        if (checked) {
            setSelectedFacilities([...selectedFacilities, facilityId]);
        } else {
            setSelectedFacilities(selectedFacilities.filter(id => id !== facilityId));
        }
    };

    return (
        <>
            <Head title="Find Your Perfect Stay" />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
                {/* Header */}
                <div className="bg-white shadow-sm border-b">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div className="flex items-center justify-between">
                            <Link href="/" className="text-2xl font-bold text-indigo-600">
                                🏨 StayFinder
                            </Link>
                            <div className="flex items-center space-x-4">
                                <Link
                                    href={route('login')}
                                    className="text-gray-600 hover:text-gray-900"
                                >
                                    Sign in
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
                                >
                                    Sign up
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Hero Section */}
                <div className="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h1 className="text-4xl md:text-6xl font-bold mb-6">
                            Find Your Perfect Stay
                        </h1>
                        <p className="text-xl md:text-2xl mb-8 text-indigo-100">
                            Discover amazing hotels, cozy inns, and beautiful houses for your next adventure
                        </p>
                    </div>
                </div>

                {/* Search Section */}
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
                    <Card className="shadow-xl">
                        <CardContent className="p-6">
                            <div className="flex flex-col lg:flex-row gap-4">
                                <div className="flex-1">
                                    <div className="relative">
                                        <Search className="absolute left-3 top-3 h-4 w-4 text-gray-400" />
                                        <Input
                                            placeholder="Search by name, location, or description..."
                                            value={searchTerm}
                                            onChange={(e) => setSearchTerm(e.target.value)}
                                            className="pl-10"
                                            onKeyPress={(e) => e.key === 'Enter' && handleSearch()}
                                        />
                                    </div>
                                </div>
                                <div className="flex gap-2">
                                    <Button
                                        onClick={() => setShowFilters(!showFilters)}
                                        variant="outline"
                                        className="flex items-center gap-2"
                                    >
                                        <Filter className="w-4 h-4" />
                                        Filters
                                    </Button>
                                    <Button onClick={handleSearch} className="bg-indigo-600 hover:bg-indigo-700">
                                        Search
                                    </Button>
                                </div>
                            </div>

                            {/* Advanced Filters */}
                            {showFilters && (
                                <div className="mt-6 pt-6 border-t border-gray-200">
                                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-2">
                                                Type
                                            </label>
                                            <Select value={selectedType} onValueChange={setSelectedType}>
                                                <SelectTrigger>
                                                    <SelectValue />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectItem value="all">All Types</SelectItem>
                                                    <SelectItem value="hotel">🏨 Hotels</SelectItem>
                                                    <SelectItem value="inn">🏡 Inns</SelectItem>
                                                    <SelectItem value="house">🏠 Houses</SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-2">
                                                Min Price
                                            </label>
                                            <Input
                                                type="number"
                                                placeholder="$0"
                                                value={minPrice}
                                                onChange={(e) => setMinPrice(e.target.value)}
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-2">
                                                Max Price
                                            </label>
                                            <Input
                                                type="number"
                                                placeholder="$1000"
                                                value={maxPrice}
                                                onChange={(e) => setMaxPrice(e.target.value)}
                                            />
                                        </div>

                                        <div className="flex items-end">
                                            <Button
                                                onClick={clearFilters}
                                                variant="outline"
                                                className="w-full"
                                            >
                                                Clear Filters
                                            </Button>
                                        </div>
                                    </div>

                                    {/* Facilities Filter */}
                                    {facilities.length > 0 && (
                                        <div className="mt-4">
                                            <label className="block text-sm font-medium text-gray-700 mb-2">
                                                Facilities
                                            </label>
                                            <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
                                                {facilities.map((facility) => (
                                                    <label
                                                        key={facility.id}
                                                        className="flex items-center space-x-2 cursor-pointer"
                                                    >
                                                        <Checkbox
                                                            checked={selectedFacilities.includes(facility.id)}
                                                            onCheckedChange={(checked) =>
                                                                handleFacilityChange(facility.id, checked as boolean)
                                                            }
                                                        />
                                                        <span className="text-sm text-gray-700">
                                                            {facility.name}
                                                        </span>
                                                    </label>
                                                ))}
                                            </div>
                                        </div>
                                    )}
                                </div>
                            )}
                        </CardContent>
                    </Card>
                </div>

                {/* Results */}
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div className="flex items-center justify-between mb-6">
                        <h2 className="text-2xl font-bold text-gray-900">
                            {accommodations.meta.total} Properties Found
                        </h2>
                    </div>

                    {accommodations.data.length > 0 ? (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {accommodations.data.map((accommodation) => (
                                <Card key={accommodation.id} className="overflow-hidden hover:shadow-lg transition-shadow">
                                    <div className="relative h-48 bg-gray-200">
                                        {accommodation.featured_image ? (
                                            <img
                                                src={accommodation.featured_image}
                                                alt={accommodation.name}
                                                className="w-full h-full object-cover"
                                            />
                                        ) : (
                                            <div className="w-full h-full flex items-center justify-center text-gray-400">
                                                <span className="text-6xl">
                                                    {accommodation.type === 'hotel' ? '🏨' : 
                                                     accommodation.type === 'inn' ? '🏡' : '🏠'}
                                                </span>
                                            </div>
                                        )}
                                        <Badge className="absolute top-2 left-2 bg-white text-gray-900">
                                            {typeLabels[accommodation.type as keyof typeof typeLabels]}
                                        </Badge>
                                    </div>
                                    
                                    <CardHeader>
                                        <CardTitle className="text-lg">
                                            {accommodation.name}
                                        </CardTitle>
                                        <CardDescription className="flex items-center text-gray-600">
                                            <MapPin className="w-4 h-4 mr-1" />
                                            {accommodation.address}
                                        </CardDescription>
                                    </CardHeader>

                                    <CardContent>
                                        <p className="text-gray-600 text-sm mb-4 line-clamp-2">
                                            {accommodation.description}
                                        </p>
                                        
                                        {accommodation.facilities.length > 0 && (
                                            <div className="flex flex-wrap gap-1 mb-4">
                                                {accommodation.facilities.slice(0, 4).map((facility) => (
                                                    <Badge
                                                        key={facility.id}
                                                        variant="secondary"
                                                        className="text-xs"
                                                    >
                                                        {facility.name}
                                                    </Badge>
                                                ))}
                                                {accommodation.facilities.length > 4 && (
                                                    <Badge variant="secondary" className="text-xs">
                                                        +{accommodation.facilities.length - 4} more
                                                    </Badge>
                                                )}
                                            </div>
                                        )}
                                    </CardContent>

                                    <CardFooter className="flex items-center justify-between">
                                        <div className="text-lg font-bold text-indigo-600">
                                            {accommodation.price_from ? (
                                                <>From ${accommodation.price_from}/night</>
                                            ) : (
                                                'Contact for pricing'
                                            )}
                                        </div>
                                        <Link
                                            href={route('accommodations.show', accommodation.id)}
                                            className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
                                        >
                                            View Details
                                        </Link>
                                    </CardFooter>
                                </Card>
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">🔍</div>
                            <h3 className="text-xl font-semibold text-gray-900 mb-2">
                                No accommodations found
                            </h3>
                            <p className="text-gray-600 mb-4">
                                Try adjusting your search criteria or clear filters to see more results.
                            </p>
                            <Button onClick={clearFilters} variant="outline">
                                Clear All Filters
                            </Button>
                        </div>
                    )}

                    {/* Pagination */}
                    {accommodations.meta.last_page > 1 && (
                        <div className="mt-8 flex justify-center">
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
            </div>
        </>
    );
}