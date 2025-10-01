import { useState } from 'react'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { countries } from '@/data/countries'

interface CountrySelectProps {
  value: string
  onValueChange: (value: string) => void
  placeholder?: string
  hasError?: boolean
  className?: string
}

export default function CountrySelect({ 
  value, 
  onValueChange, 
  placeholder = "Select country",
  hasError = false,
  className = ""
}: CountrySelectProps) {
  const [searchTerm, setSearchTerm] = useState('')
  
  const filteredCountries = countries.filter(country =>
    country.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    country.code.toLowerCase().includes(searchTerm.toLowerCase())
  )

  return (
    <Select value={value} onValueChange={onValueChange}>
      <SelectTrigger 
        className={`bg-slate-600 border-slate-500 text-white focus:border-blue-400 focus:ring-blue-400/20 ${hasError ? 'border-red-500' : ''} ${className}`}
      >
        <SelectValue placeholder={placeholder} />
      </SelectTrigger>
      <SelectContent className="bg-slate-700 border-slate-600 max-h-60">
        {/* Search input */}
        <div className="p-2 border-b border-slate-600">
          <input
            type="text"
            placeholder="Search countries..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="w-full px-3 py-2 bg-slate-600 border border-slate-500 rounded-md text-white placeholder:text-slate-400 focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-400/20"
          />
        </div>
        
        {/* Country options */}
        {filteredCountries.map((country) => (
          <SelectItem 
            key={country.code} 
            value={country.code}
            className="text-white hover:bg-slate-600 focus:bg-slate-600"
          >
            {country.name}
          </SelectItem>
        ))}
        
        {filteredCountries.length === 0 && (
          <div className="p-2 text-slate-400 text-sm">
            No countries found
          </div>
        )}
      </SelectContent>
    </Select>
  )
}
