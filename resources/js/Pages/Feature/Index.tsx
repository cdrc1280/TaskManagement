import FeatureItem from '@/Components/FeatureItem';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Feature, PaginatedData } from '@/types';
import { Head } from '@inertiajs/react';

export default function Index({ features }: { features: PaginatedData<Feature> }) {
    // console.log(features)
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Feature
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {features.data.map(feature => (
                        <FeatureItem feature={feature} />
                    ))}


                </div>
            </div>
        </AuthenticatedLayout>
    );
}
