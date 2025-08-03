import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { MapPin, Phone, Mail, Globe, Users, Ruler, ArrowLeft, Star } from 'lucide-react';

interface RoomType {
    id: number;
    name: string;
    description: string | null;
    price_per_night: number;
    max_occupancy: number;
    size_sqm: number | null;
    amenities: string[] | null;
    image: string | null;
}

interface Facility {
    id: number;
    name: string;
    icon: string | null;
}

interface Accommodation {
    id: number;
    name: string;
    type: string;
    description: string;
    address: string;
    latitude: number | null;
    longitude: number | null;
    phone: string | null;
    email: string | null;
    website: string | null;
    price_from: number | null;
    featured_image: string | null;
    gallery: string[] | null;
    facilities: Facility[];
    room_types: RoomType[];
}

interface Props {
    accommodation: Accommodation;
    [key: string]: unknown;
}

const typeLabels = {
    hotel: '🏨 Hotel',
    inn: '🏡 Inn',
    house: '🏠 House'
};

export default function AccommodationShow({ accommodation }: Props) {
    const mapUrl = accommodation.latitude && accommodation.longitude
        ? `https://www.google.com/maps?q=${accommodation.latitude},${accommodation.longitude}&z=15&output=embed`
        : null;

    return (
        <>
            <Head title={accommodation.name} />
            
            <div className="min-h-screen bg-gray-50">
                {/* Header */}
                <div className="bg-white shadow-sm border-b">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div className="flex items-center justify-between">
                            <Link href="/" className="text-2xl font-bold text-indigo-600">
                                🏨 StayFinder
                            </Link>
                            <div className="flex items-center space-x-4">
                                <Link
                                    href={route('home')}
                                    className="flex items-center text-indigo-600 hover:text-indigo-700"
                                >
                                    <ArrowLeft className="w-4 h-4 mr-1" />
                                    Back to Search
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {/* Hero Section */}
                    <div className="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            {/* Image Gallery */}
                            <div className="relative">
                                {accommodation.featured_image ? (
                                    <img
                                        src={accommodation.featured_image}
                                        alt={accommodation.name}
                                        className="w-full h-64 lg:h-96 object-cover"
                                    />
                                ) : (
                                    <div className="w-full h-64 lg:h-96 bg-gray-200 flex items-center justify-center">
                                        <span className="text-8xl">
                                            {accommodation.type === 'hotel' ? '🏨' : 
                                             accommodation.type === 'inn' ? '🏡' : '🏠'}
                                        </span>
                                    </div>
                                )}
                                <Badge className="absolute top-4 left-4 bg-indigo-600 text-white">
                                    {typeLabels[accommodation.type as keyof typeof typeLabels]}
                                </Badge>
                            </div>

                            {/* Property Info */}
                            <div className="p-6 lg:p-8">
                                <h1 className="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                                    {accommodation.name}
                                </h1>
                                
                                <div className="flex items-center text-gray-600 mb-4">
                                    <MapPin className="w-5 h-5 mr-2" />
                                    <span>{accommodation.address}</span>
                                </div>

                                {accommodation.price_from && (
                                    <div className="text-2xl font-bold text-indigo-600 mb-6">
                                        From ${accommodation.price_from}/night
                                    </div>
                                )}

                                <div className="space-y-3">
                                    {accommodation.phone && (
                                        <div className="flex items-center text-gray-600">
                                            <Phone className="w-4 h-4 mr-2" />
                                            <a href={`tel:${accommodation.phone}`} className="hover:text-indigo-600">
                                                {accommodation.phone}
                                            </a>
                                        </div>
                                    )}
                                    
                                    {accommodation.email && (
                                        <div className="flex items-center text-gray-600">
                                            <Mail className="w-4 h-4 mr-2" />
                                            <a href={`mailto:${accommodation.email}`} className="hover:text-indigo-600">
                                                {accommodation.email}
                                            </a>
                                        </div>
                                    )}
                                    
                                    {accommodation.website && (
                                        <div className="flex items-center text-gray-600">
                                            <Globe className="w-4 h-4 mr-2" />
                                            <a 
                                                href={accommodation.website} 
                                                target="_blank" 
                                                rel="noopener noreferrer"
                                                className="hover:text-indigo-600"
                                            >
                                                Visit Website
                                            </a>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {/* Main Content */}
                        <div className="lg:col-span-2 space-y-8">
                            {/* Description */}
                            <Card>
                                <CardHeader>
                                    <CardTitle>About This Property</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-gray-700 leading-relaxed">
                                        {accommodation.description}
                                    </p>
                                </CardContent>
                            </Card>

                            {/* Room Types */}
                            {accommodation.room_types.length > 0 && (
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Available Room Types</CardTitle>
                                        <CardDescription>
                                            Choose from our selection of comfortable rooms
                                        </CardDescription>
                                    </CardHeader>
                                    <CardContent>
                                        <div className="space-y-4">
                                            {accommodation.room_types.map((roomType) => (
                                                <div
                                                    key={roomType.id}
                                                    className="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow"
                                                >
                                                    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                                        <div className="mb-4 sm:mb-0">
                                                            <h3 className="text-lg font-semibold text-gray-900">
                                                                {roomType.name}
                                                            </h3>
                                                            {roomType.description && (
                                                                <p className="text-gray-600 text-sm mt-1">
                                                                    {roomType.description}
                                                                </p>
                                                            )}
                                                            
                                                            <div className="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                                                <div className="flex items-center">
                                                                    <Users className="w-4 h-4 mr-1" />
                                                                    Up to {roomType.max_occupancy} guests
                                                                </div>
                                                                {roomType.size_sqm && (
                                                                    <div className="flex items-center">
                                                                        <Ruler className="w-4 h-4 mr-1" />
                                                                        {roomType.size_sqm} m²
                                                                    </div>
                                                                )}
                                                            </div>

                                                            {roomType.amenities && roomType.amenities.length > 0 && (
                                                                <div className="flex flex-wrap gap-1 mt-2">
                                                                    {roomType.amenities.map((amenity, index) => (
                                                                        <Badge
                                                                            key={index}
                                                                            variant="secondary"
                                                                            className="text-xs"
                                                                        >
                                                                            {amenity}
                                                                        </Badge>
                                                                    ))}
                                                                </div>
                                                            )}
                                                        </div>
                                                        
                                                        <div className="text-right">
                                                            <div className="text-xl font-bold text-indigo-600">
                                                                ${roomType.price_per_night}/night
                                                            </div>
                                                            <Button className="mt-2" size="sm">
                                                                Book Now
                                                            </Button>
                                                        </div>
                                                    </div>
                                                </div>
                                            ))}
                                        </div>
                                    </CardContent>
                                </Card>
                            )}

                            {/* Map */}
                            {mapUrl && (
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Location</CardTitle>
                                        <CardDescription>
                                            {accommodation.address}
                                        </CardDescription>
                                    </CardHeader>
                                    <CardContent>
                                        <div className="aspect-video w-full rounded-lg overflow-hidden">
                                            <iframe
                                                src={mapUrl}
                                                width="100%"
                                                height="100%"
                                                style={{ border: 0 }}
                                                allowFullScreen
                                                loading="lazy"
                                                referrerPolicy="no-referrer-when-downgrade"
                                                title="Property Location"
                                            />
                                        </div>
                                    </CardContent>
                                </Card>
                            )}
                        </div>

                        {/* Sidebar */}
                        <div className="space-y-6">
                            {/* Facilities */}
                            {accommodation.facilities.length > 0 && (
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Facilities & Amenities</CardTitle>
                                    </CardHeader>
                                    <CardContent>
                                        <div className="space-y-3">
                                            {accommodation.facilities.map((facility) => (
                                                <div
                                                    key={facility.id}
                                                    className="flex items-center text-gray-700"
                                                >
                                                    <div className="w-5 h-5 mr-3 flex items-center justify-center text-indigo-600">
                                                        ✓
                                                    </div>
                                                    <span>{facility.name}</span>
                                                </div>
                                            ))}
                                        </div>
                                    </CardContent>
                                </Card>
                            )}

                            {/* Contact Card */}
                            <Card>
                                <CardHeader>
                                    <CardTitle>Contact Property</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-3">
                                    {accommodation.phone && (
                                        <Button className="w-full" variant="outline" asChild>
                                            <a href={`tel:${accommodation.phone}`}>
                                                <Phone className="w-4 h-4 mr-2" />
                                                Call Now
                                            </a>
                                        </Button>
                                    )}
                                    
                                    {accommodation.email && (
                                        <Button className="w-full" variant="outline" asChild>
                                            <a href={`mailto:${accommodation.email}`}>
                                                <Mail className="w-4 h-4 mr-2" />
                                                Send Email
                                            </a>
                                        </Button>
                                    )}
                                    
                                    <Button className="w-full" size="lg">
                                        Book Your Stay
                                    </Button>
                                </CardContent>
                            </Card>

                            {/* Reviews Placeholder */}
                            <Card>
                                <CardHeader>
                                    <CardTitle>Guest Reviews</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-center py-6">
                                        <div className="flex items-center justify-center mb-2">
                                            {[1, 2, 3, 4, 5].map((star) => (
                                                <Star
                                                    key={star}
                                                    className="w-5 h-5 text-yellow-400 fill-current"
                                                />
                                            ))}
                                        </div>
                                        <p className="text-lg font-semibold text-gray-900">4.8 out of 5</p>
                                        <p className="text-sm text-gray-600">Based on 124 reviews</p>
                                        <Button variant="outline" className="mt-4" size="sm">
                                            Read All Reviews
                                        </Button>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}