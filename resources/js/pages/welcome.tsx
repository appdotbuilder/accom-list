import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="StayFinder - Find Your Perfect Accommodation">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
                {/* Header */}
                <div className="bg-white shadow-sm border-b">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div className="flex items-center justify-between">
                            <div className="text-2xl font-bold text-indigo-600">
                                🏨 StayFinder
                            </div>
                            <div className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="text-gray-600 hover:text-gray-900 transition-colors"
                                        >
                                            Sign in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
                                        >
                                            Sign up
                                        </Link>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Hero Section */}
                <div className="relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                        <div className="relative z-10 text-center">
                            <h1 className="text-4xl md:text-6xl font-bold mb-6">
                                🏨 Find Your Perfect Stay
                            </h1>
                            <p className="text-xl md:text-2xl mb-8 text-indigo-100 max-w-3xl mx-auto">
                                Discover amazing hotels, cozy inns, and beautiful houses for your next adventure. 
                                Search, compare, and book with confidence.
                            </p>
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link
                                    href="/"
                                    className="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-50 transition-colors inline-flex items-center justify-center"
                                >
                                    🔍 Start Searching
                                </Link>
                                {auth.user && (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-indigo-500 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-indigo-400 transition-colors inline-flex items-center justify-center border-2 border-indigo-400"
                                    >
                                        📊 Admin Dashboard
                                    </Link>
                                )}
                            </div>
                        </div>
                    </div>
                    
                    {/* Decorative background elements */}
                    <div className="absolute inset-0 opacity-10">
                        <div className="absolute top-10 left-10 text-6xl">🏨</div>
                        <div className="absolute top-20 right-20 text-4xl">🏡</div>
                        <div className="absolute bottom-20 left-20 text-5xl">🏠</div>
                        <div className="absolute bottom-10 right-10 text-3xl">⭐</div>
                    </div>
                </div>

                {/* Features Section */}
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold text-gray-900 mb-4">
                            Why Choose StayFinder?
                        </h2>
                        <p className="text-xl text-gray-600 max-w-2xl mx-auto">
                            Your perfect accommodation is just a search away
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div className="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">🔍</div>
                            <h3 className="text-xl font-semibold text-gray-900 mb-2">Advanced Search</h3>
                            <p className="text-gray-600">
                                Filter by location, price, amenities, and property type to find exactly what you need.
                            </p>
                        </div>

                        <div className="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">🏨</div>
                            <h3 className="text-xl font-semibold text-gray-900 mb-2">Diverse Options</h3>
                            <p className="text-gray-600">
                                Choose from luxury hotels, charming inns, and private houses to suit any budget.
                            </p>
                        </div>

                        <div className="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">📍</div>
                            <h3 className="text-xl font-semibold text-gray-900 mb-2">Detailed Information</h3>
                            <p className="text-gray-600">
                                View comprehensive details, photos, amenities, and exact locations before booking.
                            </p>
                        </div>

                        <div className="text-center p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">⭐</div>
                            <h3 className="text-xl font-semibold text-gray-900 mb-2">Quality Assured</h3>
                            <p className="text-gray-600">
                                All properties are verified and reviewed to ensure you have a great experience.
                            </p>
                        </div>
                    </div>
                </div>

                {/* Property Types Section */}
                <div className="bg-white py-16">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">
                                Find Your Perfect Property Type
                            </h2>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div className="relative group cursor-pointer overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                                <div className="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                    <div className="text-8xl opacity-80">🏨</div>
                                </div>
                                <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
                                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <h3 className="text-2xl font-bold mb-2">Hotels</h3>
                                    <p className="text-blue-100">Luxury resorts, business hotels, and boutique properties with full service amenities.</p>
                                </div>
                            </div>

                            <div className="relative group cursor-pointer overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                                <div className="h-64 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                    <div className="text-8xl opacity-80">🏡</div>
                                </div>
                                <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
                                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <h3 className="text-2xl font-bold mb-2">Inns</h3>
                                    <p className="text-green-100">Charming bed & breakfasts and cozy inns with personal touch and local character.</p>
                                </div>
                            </div>

                            <div className="relative group cursor-pointer overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                                <div className="h-64 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                    <div className="text-8xl opacity-80">🏠</div>
                                </div>
                                <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
                                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <h3 className="text-2xl font-bold mb-2">Houses</h3>
                                    <p className="text-purple-100">Private homes, villas, and vacation rentals for families and extended stays.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* CTA Section */}
                <div className="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
                    <div className="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                        <h2 className="text-3xl font-bold text-white mb-4">
                            Ready to Find Your Perfect Stay? 🌟
                        </h2>
                        <p className="text-xl text-indigo-100 mb-8">
                            Join thousands of travelers who have found their ideal accommodations with StayFinder.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link
                                href="/"
                                className="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-50 transition-colors inline-flex items-center justify-center"
                            >
                                🔍 Browse Accommodations
                            </Link>
                            {!auth.user && (
                                <Link
                                    href={route('register')}
                                    className="bg-indigo-500 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-indigo-400 transition-colors inline-flex items-center justify-center border-2 border-indigo-400"
                                >
                                    📝 Create Account
                                </Link>
                            )}
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <div className="bg-gray-900 text-white py-8">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <p className="text-gray-400">
                            © 2024 StayFinder. Your perfect accommodation awaits. 
                            <span className="mx-2">•</span>
                            Built with Laravel & React
                        </p>
                    </div>
                </div>
            </div>
        </>
    );
}