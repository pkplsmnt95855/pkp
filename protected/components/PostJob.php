<?php

class PostJob extends CApplicationComponent {

    public function getCareerLevels()
    {
        return array('Fresh' => 'Fresh',
            'Entry Level' => 'Entry Level',
            'Officer' => 'Officer',
            'Managerial' => 'Managerial',
            'Director' => 'Director'
        );
    }

    public function getMinimumSalaries()
    {

        return array(
            '10000' => 'Rs.10,000',
            '15000' => 'Rs.15,000',
            '20000' => 'Rs.20,000',
            '25000' => 'Rs.25,000',
            '30000' => 'Rs.30,000',
            '40000' => 'Rs.40,000',
            '50000' => 'Rs.50,000',
            '60000' => 'Rs.60,000',
            '70000' => 'Rs.70,000',
            '80000' => 'Rs.80,000',
            '90000' => 'Rs.90,000',
            '100000' => 'Rs.100,000',
            '125000' => 'Rs.125,000',
            '150000' => 'Rs.150,000',
            '175000' => 'Rs.175,000',
            '200000' => 'Rs.200,000',
            '250000' => 'Rs.250,000',
            '300000' => 'Rs.300,000',
            '400000' => 'Rs.400,000',
            '500000' => 'Rs.500,000',
            '1000000' => 'Rs.1M',
        );
    }

    public function getMaximumSalaries()
    {

        return array(
            '15000' => 'Rs.15,000',
            '20000' => 'Rs.20,000',
            '25000' => 'Rs.25,000',
            '30000' => 'Rs.30,000',
            '40000' => 'Rs.40,000',
            '50000' => 'Rs.50,000',
            '60000' => 'Rs.60,000',
            '70000' => 'Rs.70,000',
            '80000' => 'Rs.80,000',
            '90000' => 'Rs.90,000',
            '100000' => 'Rs.100,000',
            '125000' => 'Rs.125,000',
            '150000' => 'Rs.150,000',
            '175000' => 'Rs.175,000',
            '200000' => 'Rs.200,000',
            '250000' => 'Rs.250,000',
            '300000' => 'Rs.300,000',
            '400000' => 'Rs.400,000',
            '500000' => 'Rs.500,000',
            '1000000' => 'Rs.1M',
        );
    }

    public function getExperienceLevels()
    {
        return array(
            '0' => 'Not Required',
            '1' => '1 Year',
            '2' => '2 Years',
            '3' => '3 Years',
            '4' => '4 Years',
            '5' => '5 Years',
            '6' => '6 Years',
            '7' => '7 Years',
            '8' => '8 Years',
            '9' => '9 Years',
            '10' => '10 Years',
            '15' => '5 Years',
        );
    }

    public function getRequiredTraveling()
    {
        return array(
            'Not Required' => 'Not Required',
            '25%' => '25%',
            '50%' => '50%',
            '75%' => '75%',
            '100%' => '100%',
        );
    }

    public function getGenders()
    {
        return array(
            'Male' => 'Male',
            'Female' => 'Female',
            'Both' => 'Both',
        );
    }

    public function getDepartments()
    {
        return array(
            'Sales ' => 'Sales ',
            'Marketing ' => 'Marketing ',
            'Advertising' => 'Advertising',
            'Investor Relations ' => 'Investor Relations ',
            'Finance and Administration ' => 'Finance and Administration ',
            'Human Resources' => 'Human Resources',
            'Engineering ' => 'Engineering ',
            'Research and Development' => 'Research and Development',
            'Operations ' => 'Operations',
            'IT and IS ' => 'IT and IS ',
            'Legal' => 'Legal',
            'Customer Service/After Sales Support ' => 'Customer Service/After Sales Support ',
            'Retail Manufacturing ' => 'Retail Manufacturing ',
            'Supply Chain/Logistics' => 'Supply Chain/Logistics',
            'Procurement' => 'Procurement',
        );
    }

    public function getIndustries()
    {
        return array(
            'Agriculture' => 'Agriculture',
            'Accounting' => 'Accounting',
            'Advertising' => 'Advertising',
            'Automotive' => 'Automotive',
            'Banking' => 'Banking',
            'Broadcasting' => 'Broadcasting',
            'Brokerage' => 'Brokerage',
            'Call Centers' => 'Call Centers',
            'Chemical' => 'Chemical',
            'Computer Sciences' => 'Computer Sciences',
            'Consumer Products' => 'Consumer Products',
            'Education' => 'Education',
            'Engineering' => 'Engineering',
            'Electronics' => 'Electronics',
            'Energy' => 'Energy',
            'Executive Search' => 'Executive Search',
            'Financial Services' => 'Financial Services',
            'Fast Moving Consumer Goods' => 'Fast Moving Consumer Goods',
            'Health Care' => 'Health Care',
            'Human Resources' => 'Human Resources',
            'Investment Banking' => 'Investment Banking',
            'Legal' => 'Legal ',
            'Manufacturing' => 'Manufacturing',
            'Pharmaceuticals' => 'Pharmaceuticals',
            'Real Estate' => 'Real Estate',
            'Retail and Wholesale' => 'Retail and Wholesale',
            'Sales and Marketing' => 'Sales and Marketing',
            'Service' => 'Service',
            'Software' => 'Software',
            'Sports' => 'Sports',
            'Technology' => 'Technology',
            'Telecommunications' => 'Telecommunications',
            'Transportation' => 'Transportation',
        );
    }

    public function getJobTypes()
    {
        return array(
            'Permanent' => 'Permanent',
            'Contractual' => 'Contractual'
        );
    }

}
